@extends('layouts.app')
@section('content')
@foreach($posts as $post)
<p>{{$post->title}}</p>
<p>{{$post->article}}</p>
@endforeach
@endsection

