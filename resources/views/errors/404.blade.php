@extends('layouts.app')
@section('title','Not found.')
@section('content')
@include('errors.errors')
<div class="container-fluid">
    <div class="row" style="text-align: center;">
        {{$exception->getMessage()}}
    </div>
</div>
@endsection