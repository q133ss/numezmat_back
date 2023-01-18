<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentController\SendCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

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
        $comment->save();
        return back();
    }
}
