@extends('layouts.app')
@section('title','Personal page')
@section('content')
<div class='container'>
    <div class='col-md-8'>
        <h1>Its your's personal page,{{$user->name}}!</h1>
        <div id='b-date'>
            <select name="b-day">
                <option value='1'>1</option>
            </select>
            <select name="b-month">
                @foreach($months as $month)
                <option value="{{$loop->iteration}}">{{$month}}</option>
                @endforeach
            </select>
            <select name='b-year'>
                @for ($i = date('Y')-70;$i <= date('Y');$i++)
                <option value='{{$i}}'>{{$i}}</option>
                @endfor
            </select>
        </div>   
        <button id='updateBday'>Save</button>
    </div>
</div>
@endsection

@section('scripts')
<!-- <meta name="_token" content="{!! csrf_token() !!}" />-->
<script src='/public/js/profile.js'></script>
@endsection