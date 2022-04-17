@extends('layouts.app')

@section('title')Update @endsection


@section('content')
<form method="POST" action="{{ route('posts.index')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['id']}}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['title']}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['post_creator']}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">created at</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['created_at']}}">
            </div>

          <button class="btn btn-success">Update</button>
        </form>
@endsection