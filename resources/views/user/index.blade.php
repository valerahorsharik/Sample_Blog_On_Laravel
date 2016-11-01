@extends('layouts.app')
@section('title','Personal page')
@section('content')
<div class='container'>
    <div class="row">
        <div class='col-md-6 col-md-offset-3'>
            <h1>Its your's personal page,{{$user->name}}!</h1>
        </div>
    </div>
    <div class="row">
        <!--<div class="col-md-4" >-->

        <div id='b-date'>
            Birthdate:
            <select name="b-day">
                <option value='{{$date['day']}}'>{{$date['day']}}</option>
            </select>
            <select name="b-month">
                @foreach($months as $month)
                    @if($loop->iteration == $date['month'])
                        <option value="{{$loop->iteration}}" selected>{{$month}}</option>
                    @else
                        <option value="{{$loop->iteration}}">{{$month}}</option>
                    @endif
                @endforeach
            </select>
            <select name='b-year'>
                @for ($i = date('Y')-70;$i <= date('Y');$i++)
                    @if($i == $date['year'])
                        <option value='{{$i}}' selected>{{$i}}</option>
                    @else
                        <option value='{{$i}}'>{{$i}}</option>
                    @endif
                @endfor
            </select>
            <!--</div>-->   
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src='/public/js/profile.js'></script>
@endsection