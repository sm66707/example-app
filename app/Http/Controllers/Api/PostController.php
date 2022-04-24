<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::with('user')->with('comments')->withTrashed()->paginate(10);
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post=Post::findOrFail($id);
        return new PostResource($post);

    }

    public function store()
    {
        $input=request()->all();
        return Post::create([
            'title'=>$input['title'],
            'writer_id'=>$input['writer_id'],
            'description'=>$input['description'],
            'slug'=>Str::slug($input['title']),

        ]);
    }
    public function delete()
    {
        $postId=request()->route()->id;
        $post=Post::withTrashed()->find($postId);

        $message=['message'=>'error post is not found'];
        if($post != null)
        {
            $post->forceDelete();
            $message=['message'=>'deletion succeeded'];
        }

        return  $message;
    }

    public function update()
    {
        $input=request()->all();

        $postId=request()->route()->id;
        $post=Post::find($postId);
        $post->title=$input['title'];
        $post->description=$input['description'];
        $post->writer_id=$input['writer_id'];
        $post->slug=Str::slug($input['title']);
        $post->save();
        return $post;
    }
}