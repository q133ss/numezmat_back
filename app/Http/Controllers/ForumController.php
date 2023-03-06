<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumController\StoreRequest;
use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Category;
use App\Models\File;
use App\Models\Forum;
use App\Traits\CanViewThisPage;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    use CanViewThisPage;
    public function __construct()
    {
        $this->checkViewPermission('view-forum');
        $this->middleware('permission:edit-forum')->only(['edit','update','updateImg','deleteImg']);
        $this->middleware('permission:block-forum')->only(['block']);
        $this->middleware('permission:create-forum')->only(['create','store']);
        $this->middleware('permission:create-sections-forum')->only(['createSection','storeSection', 'updateSection']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getMainCategories('App\Models\Forum')
            ->withOrder($request, 'catalogs', 'App\Models\Forum', Forum::class)
            ->paginate(10);
        return view('forum.index', compact('categories'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'forum.store.section', 'parent_id' => $request->parent_id]);
    }

    public function storeSection(StoreSection $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Forum';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('forums', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('forum.show', $category->id);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Forum::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Category::where('parent_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Forum::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('forum.show', $section->parent_id);
        }else{
            $route = Route('forum.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Forum::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    public function editSection($id)
    {
        $route = route('forum.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Forum')->get();
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

            $filePath = $request->file('img')->store('forums', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('forum.show', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 'App\Models\Forum')->get();
        return view('forum.create', compact('categories'));
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
        $catalog = Forum::create($data);

        foreach ($request->img as $img){
            $path = $img->store('forums', 'public');
            File::create(
                [
                    'morphable_type' => 'App\Models\Forum',
                    'morphable_id' => $catalog->id,
                    'category' => 'img',
                    'src' => '/storage/'.$path
                ]
            );
        }

        return to_route('forum.detail', $catalog->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->addView();
        $categories = Category::getSubCategories('App\Models\Forum', $id)->paginate(10);
        $items = Forum::where('forums.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('forum.show', compact('category','categories', 'items'));
    }

    public function detail($id)
    {
        $forum = Forum::findOrFail($id);
        return view('forum.detail', compact('forum'));
    }

    public function updateImg(UpdateImgRequest $request)
    {
        $src = $request->src;
        $id = $request->id;
        $img = $request->file('file')->store('forums', 'public');
        //TODO удаляем прошлый файл (пока не буду!)
        $file = File::where('morphable_type', 'App\Models\Forum')
            ->where('morphable_id', $id)
            ->where('src', $src)
            ->first();
        $file->src = '/storage/'.$img;
        $file->save();
        return $file->src;
    }

    public function deleteImg(Request $request)
    {
        File::where('morphable_type', 'App\Models\Forum')
            ->where('morphable_id', $request->id)
            ->where('src', $request->src)
            ->delete();
        unlink(public_path().$request->src);

        return response('deleted', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Forum::findOrFail($id);
        $categories = Category::where('type', 'App\Models\Forum')->get();
        return view('forum.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $data = $request->validated();

        $catalog = Forum::findOrFail($id);
        $catalog->update($data);
        return to_route('forum.detail', $id);
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

    public function block($id, $action)
    {
        Forum::findOrFail($id)->update(['is_block' => $action]);
        return to_route('forum.detail', $id);
    }
}
