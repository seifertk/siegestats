@extends('master')

@section('title', 'Player Home')

@section('content')
    <div class="panel panel-default semi-transparent">

    @if(Auth::guard('web')->user()->user_id == null)
        <h1>Oops, no email is linked to this account </h1>
    @else
        <h1>Email: {{ Auth::guard('web')->user()->email }} </h1>
        <h1>UserId: {{ Auth::guard('web')->user()->user_id }} </h1>
    @endif
    </div>   
@endsection