@extends('layouts.app')

@section('title')Show @endsection


@section('content')
   <div class=" container border border-dark rounded my-5 " >
       <div class="mx-5">
            <p class="fw-bold">post Creator Info</p>
            <hr>
            <p>Id: <span> {{ $posts['id']}} </span><p>
            <p>Name: <span> {{ $posts['post_creator']}}</span><p>
            <p>title: <span> {{ $posts['title']}} </span> </p>
            <p>created_at: <span> {{$posts['created_at']}}</span>
       </div>
       
   </div>
@endsection