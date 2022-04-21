<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\paginate;
class PostController extends Controller
{
    public function index()
    {
        // $filteredPosts= Post::where('title','javascript');
        // dd($filteredPosts);
        $posts = Post::paginate(5);
         //dd($posts); for debugging
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {    
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store()
    {
        $data=request()->all();

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);
        return redirect()->route('posts.index');
    }

    public function show($postId)
    {
        //  $post=Post::where('id',$postId)->first();
         $post=Post::find($postId);
        //  dd($post->user->email);
        // return $postId;
        return view('posts.show',['posts' => $post]);
    }
    public function edit($postId){
        $posts=Post::find($postId);
        $users = User::all();
        return view('posts.edit',['posts' => $posts ,'users'=>$users]);
    }
    public function update(Request $request, $postId)
    {
        post::where('id',$postId)->update($request->except(['_token','_method']));
        return redirect()->route('posts.index');
    }
    public function destroy($postId)
    {
        post::where('id',$postId)->delete();
        return redirect()->route('posts.index')->with('danger',"post No.$postId deleted!");
    }
}
