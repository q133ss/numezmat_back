<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingController\StoreRequest;
use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Http\Requests\RatingController\UpdateRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Category;
use App\Models\File;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-rating')->only(['edit','update','updateImg','deleteImg']);
        $this->middleware('permission:block-rating')->only(['block']);
        $this->middleware('permission:create-rating')->only(['create','store']);
        $this->middleware('permission:create-sections-rating')->only(['createSection','storeSection', 'updateSection']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getMainCategories('App\Models\Rating')
            ->withOrder($request, 'ratings', 'App\Models\Rating')
            ->paginate(10);
        return view('rating.index', compact('categories'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'rating.store.section', 'parent_id' => $request->parent_id]);
    }

    public function storeSection(StoreSection $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Rating';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('categories', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('rating.show', $category->id);
    }

    public function editSection($id)
    {
        $route = route('rating.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Rating')->get();
        return view('general.editSection', compact('route', 'section', 'categories'));
    }

    public function updateSection(UpdateSection $request, $id)
    {
        $data = $request->validated();

        unset($data['img']);

        if($request->file('img')) {
            $file = File::where('morphable_type', 'App\Models\Category')
                ->where('morphable_id', $id)
                ->first();

            unlink(public_path().$file->src);

            $filePath = $request->file('img')->store('categories', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('rating.show', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category_id = $request->category_id;

        return view('rating.create', compact('category_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth()->id();
        unset($data['img']);
        $rating = Rating::create($data);
        foreach ($request->img as $img){
            $path = $img->store('ratings', 'public');
            File::create([
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => $rating->id,
                'category' => 'img',
                'src' => '/storage/'.$path
            ]);
        }

        return to_route('rating.detail', $rating->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->addView();
        $categories = Category::getSubCategories('App\Models\Rating', $id)->paginate(10);
        $items = Rating::where('ratings.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('rating.show', compact('category','categories', 'items'));
    }

    public function detail($rating_id)
    {
        $rating = Rating::findOrFail($rating_id);
        $rating->views = $rating->views+1;
        $rating->save();
        return view('rating.detail', compact('rating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Rating::findOrFail($id);
        return view('rating.edit', compact('post'));
    }

    /**
     * @param Request $request
     * @return string
     * Change ajax file
     */
    public function updateImg(UpdateImgRequest $request)
    {
        $src = $request->src;
        $id = $request->id;
        $img = $request->file('file')->store('ratings', 'public');
        //удаляем прошлый файл (пока не буду!)
        $file = File::where('morphable_type', 'App\Models\Rating')
            ->where('morphable_id', $id)
            ->where('src', $src)
            ->first();
        $file->src = '/storage/'.$img;
        $file->save();
        return $file->src;
    }

    public function deleteImg(Request $request)
    {
        File::where('morphable_type', 'App\Models\Rating')
            ->where('morphable_id', $request->id)
            ->where('src', $request->src)
            ->delete();
        unlink(public_path().$request->src);

        return response('deleted', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        Rating::findOrFail($id)->update($request->validated());
        return to_route('rating.detail', $id);
    }

    public function block($id, $action)
    {
        Rating::findOrFail($id)->update(['is_block' => $action]);
        return to_route('rating.detail', $id);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Rating::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Category::where('parent_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Rating::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('rating.show', $section->parent_id);
        }else{
            $route = Route('rating.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Rating::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
