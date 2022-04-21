@extends('layouts.app')

@section('title')Update @endsection


@section('content')
<form method="POST" action="{{ route('posts.update',['post'=> $posts->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">title</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['title']}}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">description</label>
                <input name="description" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $posts['description']}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name='user_id' class="form-control">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
            </div>



          <button class="btn btn-success" >Update</button>
        </form>
@endsection