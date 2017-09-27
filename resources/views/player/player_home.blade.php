@extends('master')

@section('title', 'Player Home')

@section('content')
    <div class="panel panel-default semi-transparent">

    @if(Auth::guard('web')->user()->user_id == null)
        <h1>Oops!</h1>
        <h3>No R6 account is linked to this email</h3>
    @else
        <h1>Email: {{ Auth::guard('web')->user()->email }} </h1>
        <h1>UserId: {{ Auth::guard('web')->user()->user_id }} </h1>
    @endif
    </div>   
@endsection