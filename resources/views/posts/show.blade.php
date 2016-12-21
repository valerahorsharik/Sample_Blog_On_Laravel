@extends('layouts.app')
@section('title')
Post {{$post->title}}
@endsection
@section('styles')
    <link href="/public/css/posts.css" rel="stylesheet">
@endsection
@section('content')
<p>{{$post->title}}</p>
<p>{{$post->article}}</p>
<p>{{$post->created_at}}</p>
<p><a href="/profile/{{$post->user->nick_name}}">{{$post->user->name}}</a></p>
@endsection

