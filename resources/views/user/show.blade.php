@extends('layouts.app')
@section('title','Personal page')
@section('content')
<div class='container'>
    <div class="row">
        <div class='col-md-6 col-md-offset-3'>
            <h1>Its page of {{$user->nick_name}}!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-3">
            <img src="{{$user->avatara}}">
        </div>
        <div class="col-md-4 profile-data">
            <div id="name">
                Name:{{$user->name}}
            </div>
            <div id="surname">
                Surname:{{$user->surname}}
            </div>
            <div id="email">
                Email:{{$user->email}}
            </div>
            <div id="role">
                Role:{{$user->role}}
            </div>
            <div id="activity">
                Activity:<a href="/posts/{{$user->nick_name}}">{{$user->posts->count()}}</a>
            </div>
            <div id='b-date'>
                Birthdate:{{$user->birth_date}}
            </div>
        </div>

    </div>

</div>
@endsection

