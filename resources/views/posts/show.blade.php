@extends('layouts.app')
<?php
use Carbon\Carbon;
?>
@section('title')Show @endsection


@section('content')
<style>
    #first{
        background-color: #f1d8d3;
        height:150px;
    }
    #second{
        background-color: #eaaea1;
        height:150px;
    }
    #contain{
        background-color:  #eed6d1;
    }
</style>
   <div class=" container border border-dark rounded my-5 "  id="contain">

       <div class="mx-5" id="first"> 
            <p class="fw-bold">post Info</p>
            <h7>Title: {{$posts->title}}</h7><br> 
            <h7>Description: {{$posts->description}}</h7>
             
            
            <hr>
            
       </div>
       <div class="mx-5" id="second">
            <p class="fw-bold">post Creator Info</p>
            <h7>Name: {{$posts->user ? $posts->user->name : "not found"}}</h7><br> 
            <h7>Email: {{$posts->user ? $posts->user->email : "not found"}}</h7><br> 
            <h7>CreatedAt: {{ Carbon::parse($posts->created_at )->format('l jS \of F Y h:i:s A') }}</h7><br>
       </div>
       
       <div class="card mt-3 w-75">
  <div class="card-header bg-secondary text-light">
Add acomment
  </div>
  <form action="{{route('comments.store')}}" method="POST" class="row col-10 offset-1 my-2 d-flex justify-content-center" >
       @csrf
    <div class="col-lg-9  col-sm-12">
      <input id="input-msg" class="form-control border border-success shadow-sm p-2 mb-1"
       type="text" 
       onfocus="this.placeholder = ''"
      onblur="this.placeholder ='Enter  your comment'"
      placeholder ='Enter your comment'
       aria-label="default input" autocomplete="off" 
       name="body"/>
    </div>
    <input type="hidden" name="post_id"  value="{{ $posts->id }}" />
    <input type="hidden" name="parent"  value="App\Models\Post" />
    <button type="submit" id="send-btn" class="btn btn-primary ms-2 col-lg-2 col-sm-8">
      <i class="fa-solid fa-paper-plane"></i>
       comment</button>
  </form>
</div>

   </div>
@endsection