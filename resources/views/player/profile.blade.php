@extends('master')

@section('title', 'Player Profile')

@section('content')

<div class="panel panel-default">
    <div id="profile-head">
        <div id="profile-img">
            <img id="avatar" src="http://uplay-avatars.s3.amazonaws.com/{{ $player->getId() }}/default_146_146.png"/>
        </div>

        <div id="profile-stats">
            <div>
                <div id="profile-name" class="row">
                    {{ $player->getName() }}
                </div>
                <div id="player-level-container" class="row">
                    <p id="player-level">{{ $player->getLevel() }}</p>
                    <img id="clearance-border" src="/img/clearance-border.svg"/>
                </div>
            </div>
        </div>

        <div id="profile-nav">
            <ul class="nav nav-tabs navbar-right">
                <li class="active"><a data-toggle="tab" href="#overview">Player</a></li>
                <li><a data-toggle="tab" href="#operators">Operators</a></li>
                <li>
                    <a data-toggle="tab" href="#ranked">
                        Ranked
                        <img id="rank" src="/img/ranks/rank0.svg"/>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div id="content">
        <div class="tab-content">
            <div id="overview" class="tab-pane fade in active">
                <!-- @include('player.overview') -->
                <h2>Player Profile </h2>
                <?php
                    $array = json_decode(App\Http\Api\R6db::getPlayer($player->getId()), true);
                    // Hiding large arrays

                    unset($array['progressions']); // stats over the last 30 days
                    unset($array['seasonRanks']); // seasonal stats Sherlock
                    $loggedinuser = Auth::guard('web')->user()->uplay_id;
                    $profileuser = $array['id'];
                ?>
                <pre>
                    <h2>Found user id :{{$array['id']}}</h2>
                    <h2>Logged in user:{{ Auth::guard('web')->user()->uplay_id }} </h2>
                    
                    <!--Here we will make the compare link. Using the current user and logged in user. Get their stats, return 2 objects in array. Display-->
                    @if($loggedinuser === $profileuser)
                        <h1>Matching</h1>
                    @else
                        <h1>Not matching</h1>
                        {!! Form::open(['route' => 'compare', 'method' => 'post', 'id' => 'form-compare', 'class' => 'form-horizontal transparent']) !!}
                    
                            {!! Form::hidden('player_id', $profileuser) !!}
                            {!! Form::submit('Quick Compare', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    @endif

                    <?php
                        echo print_r($array, true);
                    ?>
                </pre>
            </div>
            <div id="operators" class="tab-pane">
                <h2>Operators Go Here</h2>
            </div>
            <div id="ranked" class="tab-pane">
                <h2>Ranked</h2>
                <p>stuff</p>
            </div>
        </div>
    <div>
</div>

@endsection