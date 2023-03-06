<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryController\StoreRequest;
use App\Http\Requests\LibraryController\UpdateRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Category;
use App\Models\File;
use App\Models\Library;
use App\Traits\CanViewThisPage;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    use CanViewThisPage;
    public function __construct()
    {
        $this->checkViewPermission('view-library');
        $this->middleware('permission:edit-library')->only(['edit','update','updateImg','deleteImg']);
        $this->middleware('permission:block-library')->only(['block']);
        $this->middleware('permission:create-library')->only(['create','store']);
        $this->middleware('permission:create-sections-library')->only(['createSection','storeSection', 'updateSection']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getMainCategories('App\Models\Library')
            ->withOrder($request, 'catalogs', 'App\Models\Library', Library::class)
            ->paginate(10);
        return view('library.index', compact('categories'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'library.store.section', 'parent_id' => $request->parent_id]);
    }

    function storeSection(StoreSection $request){
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Library';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('libraries', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('library.show', $category->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 'App\Models\Library')->get();
        return view('library.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $library = Library::create($request->validated());
        foreach ($request->img as $img){
            $path = $img->store('libraries', 'public');
            File::create(
                [
                    'morphable_type' => 'App\Models\Library',
                    'morphable_id' => $library->id,
                    'category' => 'img',
                    'src' => '/storage/'.$path
                ]
            );
        }
        return to_route('library.detail', $library->id);
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
        $categories = Category::getSubCategories('App\Models\Library', $id)
            ->withOrder($request, 'catalogs', 'App\Models\Library', Library::class)
            ->paginate(10);
        $items = Library::where('libraries.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('library.show', compact('category','categories', 'items'));
    }

    public function detail($id)
    {
        $library = Library::findOrFail($id);
        return view('library.detail', compact('library'));
    }

    public function editSection($id)
    {
        $route = route('library.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Library')->get();
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

            $filePath = $request->file('img')->store('libraries', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('library.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Library::findOrFail($id);
        return view('library.edit', compact('post'));
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
        $post = Library::find($id);

        if($request->file('img') != null){
            unlink(public_path().'/'.$post->img());

            $file = $request->file('img')->store('libraries', 'public');
            $post->file()->update(['src' => '/storage/'.$file]);
        }

        $data = $request->validated();
        unset($data['img']);

        $post->update($data);

        return to_route('library.detail', $id);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Library::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Category::where('parent_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Library::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('library.show', $section->parent_id);
        }else{
            $route = Route('library.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Library::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    public function block($id, $action)
    {
        Library::findOrFail($id)->update(['is_block' => $action]);
        return to_route('library.detail', $id);
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
