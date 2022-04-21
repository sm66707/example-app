<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $comment =  Comment::create([
            'body' => $request->body,
            'user_id' => $request->user_id,
            'commentable_id' => $request->post_id,
            'commentable_type' => $request->parent
        ]);

        return redirect()
            ->route('posts.show', [
                'post' => $request->post_id,
            ])
            ->with('success', "your comment is added ");
    }



}
