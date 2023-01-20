<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsController\UpdateRequest;
use App\Models\File;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at','DESC')->paginate(1);
        return view('news.index', compact('news'));
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
            //$post->file()->delete();

            $file = $request->file('img')->store('news', 'public');
//            File::create([
//                'morphable_type' => 'App\Models\News',
//                'morphable_id' => $post->id,
//                'src' => '/storage/'.$file,
//                'category' => 'img'
//            ]);
            $post->file()->update(['src' => '/storage/'.$file]);
        }

        $data = $request->validated();
        unset($data['img']);

        $post->update($data);

        return to_route('news.show', $id);
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
