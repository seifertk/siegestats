@extends ('master')

@section('title', 'Leaderboard')

@section('content')
<div class="panel panel-default semi-transparent">
    {!! Form::open(['route' => 'leaderboard.search', 'method' => 'post', 'id' => 'form-search', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
    {!! Form::token() !!}
        <div id="leaderboard-search" class="row form-group">
            <label>Platform</label>
            <select class="btn btn-default form-control leaderboard-input" name="platform">
                <option value="pc">PC</option>
                <option value="ps4">PS4</option>
                <option value="xbox">Xbox One</option>
            </select>

            <label>Region</label>
            <select class="btn btn-default form-control leaderboard-input" name="stat">
                <option value="highest_skill_adjusted">Global</option>
                <option value="apac_skill_adjusted">Asia and Pacific Area</option>
                <option value="emea_skill_adjusted">Europe, Middle East, and Africa</option>
                <option value="ncsa_skill_adjusted">North, Central, and South America</option>
            </select>

            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    {!! Form::close() !!}
    <div class="panel panel-default semi-transparent">

        @foreach ($players as $player)
            <div class="player-index-item">
                <div class="player-index-placement" style="">
                    {{$player->placement}}
                </div>
                <div class="player-index-item-img">
                    <a href="{{route('profile', ['id' => $player->id])}}">
                        <img src="{{siegestats_avatar_link($player->id)}}" alt="{{$player->name}}"/>
                    </a>
                </div>
                <div class="player-index-item-block">
                    <h1>{{$player->name}}</h2>
                    <h4><b>Skill Rating</b> : {{$player->value}}</h4>

                    {!! Form::open(['route' => 'link', 'method' => 'post', 'id'=>'form-link', 'class' => 'form-horizontal transparent']) !!}
                        {!! Form::hidden('player_id', $player->id) !!}
                        {!! Form::hidden('player_name', $player->name) !!}
                        <a href="{{route('profile', ['id' => $player->id])}}" class="btn btn-primary">View Profile</a>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection