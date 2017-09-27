@extends('master')

@section('title', 'Player Search Results')

@section('content')
    <div class="panel panel-default semi-transparent">

    @foreach ($players as $player)
        {!! Form::open(['route' => 'link', 'method' => 'post', 'id'=>'form-link', 'class' => 'form-horizontal transparent']) !!}
            <h4>name:     {{$player->name}}</h4>
            <ul>
                <li><b>id :</b>        {{$player->id}}</li>
                <li><b>userId :</b>    {{$player->userId}}</li>
                <li><b>level :</b>     {{$player->level}}</li>
            </ul>
            {!! Form::hidden('player_id', $player->userId) !!}
            {!! Form::hidden('player_name', $player->name) !!}
            {!! Form::submit('Link This Account', ['class' => 'btn btn-primary']) !!}
        <hr/>
        <br/>
        {!! Form::close() !!}
    @endforeach

    </div>
@endsection