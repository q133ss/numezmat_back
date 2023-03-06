<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingController\StoreRequest;
use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Http\Requests\RatingController\UpdateRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Category;
use App\Models\Expertise;
use App\Models\File;
use App\Traits\CanViewThisPage;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    use CanViewThisPage;
    public function __construct()
    {
        $this->checkViewPermission('view-expertise');
        $this->middleware('permission:edit-expertise')->only(['edit','update','updateImg','deleteImg']);
        $this->middleware('permission:block-expertise')->only(['block']);
        $this->middleware('permission:create-expertise')->only(['create','store']);
        $this->middleware('permission:create-sections-expertise')->only(['createSection','storeSection', 'updateSection']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getMainCategories('App\Models\Expertise')
            ->withOrder($request, 'expertise', 'App\Models\Expertise', Expertise::class)
            ->paginate(10);
        return view('expertise.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category_id = $request->category_id;

        return view('expertise.create', compact('category_id'));
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
        $expertise = Expertise::create($data);
        foreach ($request->img as $img){
            $path = $img->store('ratings', 'public');
            File::create([
                'morphable_type' => 'App\Models\Expertise',
                'morphable_id' => $expertise->id,
                'category' => 'img',
                'src' => '/storage/'.$path
            ]);
        }

        return to_route('expertise.detail', $expertise->id);
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
        $categories = Category::getSubCategories('App\Models\Expertise', $id)->paginate(10);
        $items = Expertise::where('expertises.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('expertise.show', compact('category','categories', 'items'));
    }

    public function detail($expertise_id)
    {
        $expertise = Expertise::findOrFail($expertise_id);
        $expertise->views = $expertise->views+1;
        $expertise->save();
        return view('expertise.detail', compact('expertise'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'expertise.store.section', 'parent_id' => $request->parent_id]);
    }

    public function storeSection(StoreSection $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Expertise';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('expertise', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('expertise.show', $category->id);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Expertise::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Category::where('parent_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Expertise::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('expertise.show', $section->parent_id);
        }else{
            $route = Route('expertise.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Expertise::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    public function editSection($id)
    {
        $route = route('expertise.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Expertise')->get();
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

            $filePath = $request->file('img')->store('expertises', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('expertise.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Expertise::findOrFail($id);
        return view('expertise.edit', compact('post'));
    }

    public function updateImg(UpdateImgRequest $request)
    {
        $src = $request->src;
        $id = $request->id;
        $img = $request->file('file')->store('expertises', 'public');
        //TODO удаляем прошлый файл (пока не буду!)
        $file = File::where('morphable_type', 'App\Models\Expertise')
            ->where('morphable_id', $id)
            ->where('src', $src)
            ->first();
        $file->src = '/storage/'.$img;
        $file->save();
        return $file->src;
    }

    public function deleteImg(Request $request)
    {
        File::where('morphable_type', 'App\Models\Expertise')
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
        Expertise::findOrFail($id)->update($request->validated());
        return to_route('expertise.detail', $id);
    }

    public function block($id, $action)
    {
        Expertise::findOrFail($id)->update(['is_block' => $action]);
        return to_route('expertise.detail', $id);
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
