@extends('master')

@section('title', 'Player Home')

@section('content')
    @if(Auth::guard('web')->user()->user_id == null)
        <div class="panel panel-default">
            <h1>Oops, no email is linked to this account </h1>
        </div>
    @else
        <div class="panel panel-default">
            <h1>Email: {{ Auth::guard('web')->user()->email }} </h1>
        </div>
    @endif
@endsection