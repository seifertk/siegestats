@extends('master')

@section('title', 'Player Search Results')


@section('content')
    <div class="panel panel-default">

    @foreach ($players as $player)
        <p>
            <h2>Name:    {{$player->name}}</h2>
            <h2>ID:      {{$player->id}}</h2>
            <h2>Level:    {{$player->level}}</h2>
        </p>
        <br/>
    @endforeach

    </div>
@endsection