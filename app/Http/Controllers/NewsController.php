<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsController\StoreRequest;
use App\Http\Requests\NewsController\UpdateRequest;
use App\Models\File;
use App\Models\News;
use Illuminate\Http\Request;
use App\Traits\CanViewThisPage;

class NewsController extends Controller
{
    use CanViewThisPage;
    public function __construct()
    {
        $this->checkViewPermission('view-news');
        $this->middleware('permission:edit-news')->only(['edit','update']);
        $this->middleware('permission:block-news')->only('block');
        $this->middleware('permission:create-news')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::withOrder($request)->where('is_block', false)->paginate(10);
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
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
        unset($data['img']);
        $news = News::create($data);

        $file = new File();
        $file->morphable_type = 'App\Models\News';
        $file->morphable_id = $news->id;
        $path = $request->file('img')->store('news', 'public');
        $file->src = '/storage/'.$path;
        $file->category = 'img';
        $file->save();

        return to_route('news.show', $news->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = News::findOrFail($id);
        return view('news.edit', compact('post'));
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
        $post = News::find($id);

        if($request->file('img') != null){
            unlink(public_path().'/'.$post->img());

            $file = $request->file('img')->store('news', 'public');
            $post->file()->update(['src' => '/storage/'.$file]);
        }

        $data = $request->validated();
        unset($data['img']);

        $post->update($data);

        return to_route('news.show', $id);
    }

    public function block(Request $request)
    {
        News::findOrFail($request->post_id)->update(['is_block' => true]);
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
