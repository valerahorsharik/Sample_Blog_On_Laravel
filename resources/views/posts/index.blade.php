@extends('layouts.app')
@section('title','Posts')
@section('styles')
    <link href="/public/css/posts.css" rel="stylesheet">
@endsection
@section('content')
@include('errors.errors')
<div class="container posts-main-container">
    @foreach($posts as $post)

    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 post">
        <div class="row"><a href="/post/{{$post->id}}"><h3>{{$post->title}}</h3></a></div>
        <div class="row">{{$post->article}}</div>
        <div class="row">
            <div class="col-md-2 options">
                @if(Auth::check())
                    @if ($post->user_id == Auth::user()->id)
                        <a class="delete_post_href" href="/post/delete/{{$post->id}}">x</a>
                        <a class="delete_post_href" href="/post/edit/{{$post->id}}">u</a>
                    @endif
                @endif
            </div>
            <div class="col-md-2 col-md-offset-3 text-center">
                <div class="comments-icon"></div> {{$post->comments_count}}
            </div>
            <div class="col-md-4  col-md-offset-1 text-right">
                Author:{{$post->author}}
            </div>
        </div>         
    </div>

    @endforeach
</div>
@endsection
@section('scripts')
<script src='/public/js/posts.js'></script>
@endsection

