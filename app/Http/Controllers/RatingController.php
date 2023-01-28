<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingController\UpdateImgRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getMainCategories('App\Models\Rating')->paginate(10);
        return view('rating.index', compact('categories'));
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
        $categories = Category::getSubCategories('App\Models\Rating', $id)->paginate(10);
        $items = Rating::where('ratings.category_id', $category->id)->withFilter($request)->paginate(10);

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

    #TODO добавить проверку прав на удаление и изменение файлов!
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
