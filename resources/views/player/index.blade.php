@extends('master')

@section('title', 'Player Search Results')

@section('content')
    <div class="panel panel-default semi-transparent">

    @foreach ($players as $player)
    <div class="player-index-item">
        <div class="player-index-item-img">
            <img src="{{siegestats_avatar_link($player->id)}}" alt="{{$player->name}}"/>
        </div>
        <div class="player-index-item-block">
        
            <span>{{$player->name}}</span>
            <ul>
                <li><b>Id :</b>          {{$player->id}}</li>
                <li><b>Uplay Id :</b>    {{$player->userId}}</li>
                <li><b>Level :</b>       {{$player->level}}</li>
            </ul>
            {!! Form::open(['route' => 'link', 'method' => 'post', 'id'=>'form-link', 'class' => 'form-horizontal transparent']) !!}
                {!! Form::hidden('player_id', $player->id) !!}
                {!! Form::hidden('player_name', $player->name) !!}
                <a href="{{route('profile', ['id' => $player->id])}}" class="btn btn-primary">View Profile</a>
                {!! Form::submit('Link This Account', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        
        
        </div>


    </div>

    @endforeach

    </div>
@endsection
