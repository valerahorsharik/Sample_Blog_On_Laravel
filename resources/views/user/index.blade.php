@extends('layouts.app')
@section('title','Personal page')
@section('styles')
    <link href="/public/css/profile.css" rel="stylesheet">
@endsection
@section('content')
<div class='container'>
    <div class="row" >
        <div class="col-md-4 col-md-offset-4" id="message-profile"></div>
    </div>
    <div class="row">
        <div class='col-md-6 col-md-offset-3'>
            <h1>Its your's personal page,{{$user->nick_name}}!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-3">
            <!--uploading image-->
<!--        <form enctype="multipart/form-data" method="post" action="/profile/update/">

                {{ csrf_field() }}
                <img                            src="{{$user->avatara}}">
                <div id="avatara">
                    <input type="file" name="avatar" />
                </div>
                <input type="submit" name="submit">
            </form>-->
            <img src="{{$user->avatara}}">
        </div>
        <div class="col-md-4 profile-data">
            <div id="name">
                Name:<input type="text" class="data" value="{{$user->name}}"/>
            </div>
            <div id="surname">
                Surname:<input type="text" class="data" value="{{$user->surname}}"/>
            </div>
            <div id="email">
                Email:<input type="email" class="data" value="{{$user->email}}"/>
            </div>
            <div id="role">
                Role:{{$user->role}}
            </div>
            <div id="activity">
                Activity:<a href="/posts/{{$user->nick_name}}">{{$user->posts->count()}}</a>
            </div>
            <div id='b-date'>
                Birthdate:
                <select name="b-day" class="data">
                    <option value='{{$date['day']}}'>{{$date['day']}}</option>
                </select>
                <select name="b-month" class="data">
                    @foreach($months as $month)
                        @if($loop->iteration == $date['month'])
                            <option value="{{$loop->iteration}}" selected>{{$month}}</option>
                        @else
                            <option value="{{$loop->iteration}}">{{$month}}</option>
                        @endif
                    @endforeach
                </select>
                <select name="b-year" class="data">
                    @for ($i = date('Y')-70;$i <= date('Y');$i++)
                        @if($i == $date['year'])
                            <option value='{{$i}}' selected>{{$i}}</option>
                        @else
                            <option value='{{$i}}'>{{$i}}</option>
                        @endif
                    @endfor
                </select> 
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
    <script src='/public/js/profile.js'></script>
@endsection