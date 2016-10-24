@extends('layouts.app')
@section('title','Posts')
@section('content')
@include('errors.errors')
<div class="container">
    @foreach($posts as $post)

    <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2" style="word-wrap: break-word; ">
        <a href="/posts/{{$post->id}}"><h3>{{$post->title}}</h1></a>
        {{$post->article}}
        <div class="col-md-offset-8  col-xs-offset-6" style="text-align: right">
            Author:{{$post->user->name}}
        </div>
        <hr/>
    </div>

    @endforeach
</div>
@endsection

