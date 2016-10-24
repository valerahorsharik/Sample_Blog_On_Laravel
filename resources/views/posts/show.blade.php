@extends('layouts.app')
@section('title','Post {{$post->title}}')
@section('content')
<p>{{$post->title}}</p>
<p>{{$post->article}}</p>
<p>{{$post->created_at}}</p>
<p>{{$post->user->name}}</p>
@endsection

