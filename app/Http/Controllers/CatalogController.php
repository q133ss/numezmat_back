<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Http\Requests\CatalogController\UpdateRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Expertise;
use App\Models\File;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getMainCategories('App\Models\Catalog')->paginate(10);
        return view('catalog.index', compact('categories'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'catalog.store.section', 'parent_id' => $request->parent_id]);
    }

    public function storeSection(StoreSection $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Catalog';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('catalogs', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('catalog.show', $category->id);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Catalog::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Category::where('parent_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Catalog::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('catalog.show', $section->parent_id);
        }else{
            $route = Route('catalog.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Catalog::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    public function editSection($id)
    {
        $route = route('catalog.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Catalog')->get();
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

            $filePath = $request->file('img')->store('catalogs', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('catalog.show', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $categories = Category::getSubCategories('App\Models\Catalog', $id)->paginate(10);
        $items = Catalog::where('catalogs.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('catalog.show', compact('category','categories', 'items'));
    }

    public function detail($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('catalog.detail', compact('catalog'));
    }

    public function updateImg(UpdateImgRequest $request)
    {
        $src = $request->src;
        $id = $request->id;
        $img = $request->file('file')->store('catalogs', 'public');
        //TODO удаляем прошлый файл (пока не буду!)
        $file = File::where('morphable_type', 'App\Models\Catalog')
            ->where('morphable_id', $id)
            ->where('src', $src)
            ->first();
        $file->src = '/storage/'.$img;
        $file->save();
        return $file->src;
    }

    public function deleteImg(Request $request)
    {
        File::where('morphable_type', 'App\Models\Catalog')
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
        $post = Catalog::findOrFail($id);
        return view('catalog.edit', compact('post'));
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
        dd($request->validated());
        Catalog::findOrFail($id)->update($request->validated());
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

    public function block($id, $action)
    {
        Catalog::findOrFail($id)->update(['is_block' => $action]);
        return to_route('catalog.detail', $id);
    }
}
