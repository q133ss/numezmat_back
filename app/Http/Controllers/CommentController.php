<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionCommentRequest;
use App\Http\Requests\CommentController\SendCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function sendComment(SendCommentRequest $request)
    {
        $type = ucfirst($request->type);
        $comment = new Comment();
        $comment->morphable_type = "App\Models\\$type";
        $comment->morphable_id = $request->post_id;
        $comment->user_id = Auth()->id();
        $comment->text = $request->text;
        $comment->coin_id = $request->coin_id;
        $comment->reply_id = $request->reply_id;
        $comment->save();
        return back();
    }

    public function actionComment(ActionCommentRequest $request)
    {
        if(Auth()->check()) {
            $table = DB::table('comment_likes');

            if($table->where('user_id', Auth()->id())
                ->where('comment_id', $request->comment_id)
                ->exists()
            ){
                $table->where('user_id', Auth()->id())
                    ->where('comment_id', $request->comment_id)
                    ->delete();
                $comment = Comment::find($request->comment_id);
                return view('includes.likes', compact('comment'))->render();
            }else {
                $table->insert(
                    [
                        'comment_id' => $request->comment_id,
                        'user_id' => Auth()->id(),
                        'type' => $request->action
                    ]
                );
                $comment = Comment::find($request->comment_id);
                return view('includes.likes', compact('comment'))->render();
            }
        }else{
            return response('not auth', 403);
        }
    }
}
