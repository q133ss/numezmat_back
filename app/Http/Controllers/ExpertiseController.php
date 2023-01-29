<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSection;
use App\Models\Category;
use App\Models\Expertise;
use App\Models\File;
use App\Models\Rating;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getMainCategories('App\Models\Expertise')->paginate(10);
        return view('expertise.index', compact('categories'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
