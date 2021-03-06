@extends('layouts.app')
@section('title','Posts')
@section('styles')
    <link href="/public/css/posts.css" rel="stylesheet">
@endsection
@section('content')
@include('errors.errors')
<div class="container posts-main-container">
    @if(count($posts) == 0)
    <div class="col-md-4 col-md-offset-4 text-center">
        Here is no articles.
    </div>
    @endif
    @foreach($posts as $post)

    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 post" data-post-id="{{$post->id}}">
        <div class="row"><a href="/post/{{$post->id}}"><h3>{{$post->title}}</h3></a></div>
        <div class="row">{{$post->article}}</div>
        <div class="row">
            <div class="col-md-2 options">
                <span class="glyphicon glyphicon-comment"></span> {{$post->comments_count}}
                @if(Auth::check())
                    @if ($post->user_id == Auth::user()->id)
                            <span class="glyphicon glyphicon-trash delete-post"></span>
                            <span class="glyphicon glyphicon-edit  edit-post"></span>
                    @endif
                @endif
            </div>
            <div class="col-md-4  col-md-offset-6 text-right">
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

