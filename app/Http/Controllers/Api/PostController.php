<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    
    public function index(){

        $post= Post::all();
        return PostResource::collection($posts);

    }

    public function show($postId){
         $post=Post::find($postId);

         return new PostResource($post);
        //  return [
        //      'id' => $post->id,
        //      'title' => $post->title,
        //      'description' =>  $post->description,
        //     'user_id' => $post->user_id,
        //  ];
 
    }



    public function store(StorePostRequest $request){
        $data = request()->all();

        $post=Post::create([
            'title' =>  $request['title'],
            'description' =>  $request['description'],
            'user_id' => $request['user_id'],
            'slug' =>Str::slug($request->input('title'),'-'),
            'image'=>$name,
        ]);
        return new PostResource($post);

    }


}