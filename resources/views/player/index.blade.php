@extends('master')

@section('title', 'Player Search Results')


@section('content')
    <div class="panel panel-default semi-transparent">

    @foreach ($players as $player)
        <p>
        {!! Form::open(['route' => 'link', 'method' => 'post']) !!}
            <h4>name:     {{$player->name}}</h4>
            <ul>
                <li><b>id :</b>        {{$player->id}}</li>
                <li><b>userId :</b>    {{$player->userId}}</li>
                <li><b>level :</b>     {{$player->level}}</li>
            </ul>
            <input name='player_id' id='player_id' value={{ $player->userId }} hidden />
            <button type="submit" class="btn btn-default">Link This Account</button>
        </p>
        <hr/>
        <br/>
        {!! Form::close() !!}
    @endforeach

    </div>
@endsection