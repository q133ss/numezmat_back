<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Http\Requests\ShopController\StoreRequest;
use App\Http\Requests\ShopController\UpdateRequest;
use App\Http\Requests\StoreSection;
use App\Http\Requests\UpdateSection;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Traits\CanViewThisPage;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use CanViewThisPage;
    public function __construct()
    {
        $this->checkViewPermission('view-shop');
        $this->middleware('permission:edit-shop')->only(['edit','update','updateImg','deleteImg']);
        $this->middleware('permission:block-shop')->only(['block']);
        $this->middleware('permission:create-shop')->only(['create','store']);
        $this->middleware('permission:create-sections-shop')->only(['createSection','storeSection', 'updateSection']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getMainCategories('App\Models\Shop')
            ->withOrder($request, 'products', 'App\Models\Shop', Product::class)
            ->paginate(10);
        return view('shop.index', compact('categories'));
    }

    public function createSection(Request $request)
    {
        return view('general.createSection', ['route' => 'shop.store.section', 'parent_id' => $request->parent_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 'App\Models\Shop')->get();
        return view('shop.create', compact('categories'));
    }

    function storeSection(StoreSection $request){
        $data = $request->validated();
        unset($data['img']);
        $data['type'] = 'App\Models\Shop';
        $data['parent_id'] = $request->parent_id;
        $category = Category::create($data);
        $filePath = $request->file('img')->store('shops', 'public');
        File::create([
            'morphable_type' => 'App\Models\Category',
            'morphable_id' => $category->id,
            'src' => '/storage/'.$filePath,
            'category' => 'img'
        ]);

        return to_route('shop.show', $category->id);
    }

    public function editSection($id)
    {
        $route = route('shop.update.section', $id);
        $section = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->where('type', 'App\Models\Shop')->get();
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

            //unlink(public_path().$file->src);

            $filePath = $request->file('img')->store('shops', 'public');
            $file->src = '/storage/' . $filePath;
            $file->save();
        }

        Category::findOrFail($id)->update($data);
        return to_route('shop.show', $id);
    }

    public function updateImg(UpdateImgRequest $request)
    {
        $src = $request->src;
        $id = $request->id;
        $img = $request->file('file')->store('shops', 'public');
        //TODO удаляем прошлый файл (пока не буду!)
        $file = File::where('morphable_type', 'App\Models\Product')
            ->where('morphable_id', $id)
            ->where('src', $src)
            ->first();
        $file->src = '/storage/'.$img;
        $file->save();
        return $file->src;
    }

    public function deleteImg(Request $request)
    {
        File::where('morphable_type', 'App\Models\Shop')
            ->where('morphable_id', $request->id)
            ->where('src', $request->src)
            ->delete();
        unlink(public_path().$request->src);

        return response('deleted', 200);
    }

    public function deleteSection($id)
    {
        $section = Category::findOrFail($id);

        $category_ids = [];
        //Добавляем текущую категорию
        $category_ids[] = $section->id;

        $item_ids = [];
        //Добавляем текущую категорию
        foreach (Product::where('category_id', $id)->get() as $rating) {
            $item_ids[] = $rating->id;
        }

        while(true){
            $item = Product::where('category_id', last($category_ids));
            if($item->exists()) {
                $category_id = $item->pluck('id')->first();

                $category_ids[] = $category_id;
                foreach (Product::where('category_id', $category_id)->get() as $rating) {
                    $item_ids[] = $rating->id;
                }
            }else{
                break;
            }
        }

        //если есть родительская категория, то переходим в нее, иначе на главную
        if($section->parent_id != null){
            $route = Route('shop.show', $section->parent_id);
        }else{
            $route = Route('shop.index');
        }
        //Удаляем все и делаем редирект
        #TODO Добавить удаление файлов!
        Product::whereIn('id', $item_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return redirect($route);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $product = Product::create($request->validated());
        foreach ($request->img as $img){
            $path = $img->store('products', 'public');
            File::create(
                [
                    'morphable_type' => 'App\Models\Product',
                    'morphable_id' => $product->id,
                    'category' => 'img',
                    'src' => '/storage/'.$path
                ]
            );
        }
        return to_route('shop.detail', $product->id);
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
        $categories = Category::getSubCategories('App\Models\Shop', $id)->paginate(10);
        $items = Product::where('products.category_id', $category->id)->where('is_block', false)->withFilter($request)->paginate(10);

        return view('shop.show', compact('category','categories', 'items'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Product::findOrFail($id);
        $categories = Category::where('type', 'App\Models\Shop')->get();
        return view('shop.edit', compact('post','categories'));
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
        $catalog = Product::findOrFail($id);
        $catalog->update($request->validated());

        return to_route('shop.detail', $id);
    }

    public function block($id, $action)
    {
        Product::findOrFail($id)->update(['is_block' => $action]);
        return to_route('shop.detail', $id);
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
