<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Jobs\ProcessPodcast;
use App\Http\Controllers\paginate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        ProcessPodcast::dispatch();
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {    
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store(StorePostRequest $request)
    {   if ($request->hasFile('fileUpload')) {
        $image=$request->file('fileUpload');
        $name = $image->getClientOriginalName();
        $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        Post::create([
            'title' =>  $request['title'],
            'description' =>  $request['description'],
            'user_id' => $request['post_creator'],
            'slug' =>Str::slug($request->input('title'),'-'),
            'image'=>$name,
        ]);
    } 
        return redirect()->route('posts.index');
    }

    public function show($postId)
    {

         $post=Post::find($postId);
        return view('posts.show',['posts' => $post]);
    }

    public function edit($postId){
        $posts=Post::find($postId);
        $users = User::all();
        return view('posts.edit',['posts' => $posts ,'users'=>$users]);
    }
    public function update(UpdatePostRequest $request, $postId)
    {   
        $post=Post::find($postId);
        $name = $post->image;
        if ($request->hasFile('fileUpload')) {

            if ($name != null) {
                File::delete(public_path( Storage::url($post->image)));
            }
            $image=$request->file('fileUpload');
            $name = $image->getClientOriginalName();
            $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        }

        Post::where('id',$postId)->update([
            'title' =>  $request['title'],
            'description' =>  $request['description'],
            'user_id' => $request['user_id'],
            'slug' =>Str::slug($request->input('title'),'-'),
            'image'=>$name,
        ]);

        return redirect()->route('posts.index');
    }
    public function destroy($postId)
    {
        post::where('id',$postId)->delete();
        
        return redirect()->route('posts.index')->with('danger',"post No.$postId deleted!");
    }
}
