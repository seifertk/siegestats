@extends('master')

@section('title', 'Player Profile')

@section('content')

<div class="panel panel-default">
    <div id="profile-head">
        <div id="profile-img">
            <img src="/img/operators/bandit_badge.png"/>
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
                @include('player.overview')
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