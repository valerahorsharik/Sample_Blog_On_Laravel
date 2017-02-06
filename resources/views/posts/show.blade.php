@extends('layouts.app')
@section('title')
Post {{$post->title}}
@endsection
@section('styles')
<link href="/public/css/posts.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 post">
        <div class="row"><h3>{{$post->title}}</h3></div>
        <div class="row">{{$post->article}}</div>
        <div class="row">
            <div class="col-md-2 options">
                @if(Auth::check())
                    @if ($post->user_id == Auth::user()->id)
                        <a class="delete_post_href" href="/post/delete/{{$post->id}}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        <a class="delete_post_href" href="/post/edit/{{$post->id}}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    @endif
                @endif
            </div>
            <div class="col-md-4  col-md-offset-6 text-right">
                <a href="/profile/{{$post->user->nick_name}}">{{$post->user->name}}</a> {{$post->created_at}}
            </div>
        </div>
        <div class="row"> 
            <div class="download-comments toggle-comments"  data-post-id="{{$post->id}}">
                @if (count($post->comments) > 0)
                    Show comments.
                @else
                    Add first comment.
                @endif 
            </div>
        </div>
    </div>

    @endsection
    @section('scripts')
    <script src='/public/js/posts.js'></script>
    @endsection
