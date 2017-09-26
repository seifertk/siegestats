@extends('master')

@section('title', 'Player Search Results')


@section('content')
    <div class="panel panel-default">

    @foreach ($players as $player)
        <p>
            <h4>name:     {{$player->name}}</h4>
            <ul>
                <li><b>id :</b>       {{$player->id}}</li>
                <li><b>userId :</b>   {{$player->userId}}</li>
                <li><b>level :</b>    {{$player->level}}</li>
            </ul>
            
        </p>
        <br/>
    @endforeach

    </div>
@endsection