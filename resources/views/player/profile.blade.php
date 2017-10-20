@extends('master')

@section('title', 'Player Profile')

@section('content')

<div class="panel panel-default">
    <div id="profile-head">
        <div id="profile-img">
            <img id="avatar" src="{{siegestats_avatar_link($player->getId())}}"/>
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
            <h1>Player Profile </h1>
            <div class="row">
                <div class="col-md-6">
                    <h2>General Stats</h2>
                    <table class="table table-condensed">
                        <tr>
                            <th>Name</th>
                            <td>{{$player->getName()}}</td>
                        </tr>
                        <tr>
                            <th>Platform</th>
                            <td>{{$player->getPlatform()}}</td>
                        </tr>
                        <tr>
                            <th>Clearance</th>
                            <td>{{$player->getLevel()}}</td>
                        </tr>
                        <tr>
                            <th>Rank</th>
                            <td>{{json_encode($player->getRank())}}</td>
                        </tr>
                        <tr>
                            <th>Last Played</th>
                            <td>{{$player->getLastPlayed()->diffForHumans()}}</td>
                        </tr>
                        <tr>
                            <th>Player Since</th>
                            <td>{{$player->getCreatedAt()->format('Y-m-d')}}</td>
                        </tr>
                        <tr>
                            <th>Time Played</th>
                            <td>{{$player->getStats('general')->getTimePlayedString()}}</td>
                        </tr>
                        <tr>
                            <th>Casual Hours</th>
                            <td>{{$player->getStats('casual')->getTimePlayedString()}}</td>
                        </tr>
                        <tr>
                            <th>Ranked Hours</th>
                            <td>{{$player->getStats('ranked')->getTimePlayedString()}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-tabs" id="stats_tabs">
                        @foreach (array_merge($player->getModeTypes(), $player->getMatchTypes()) as $stat)
                            <li class="nav-item"><a href="#{{$stat->getStatName()}}" class="nav-link">{{$stat->getStatName()}}</a></li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($player->getMatchTypes() as $stat)
                            <div class="tab-pane" id="{{$stat->getStatName()}}" role="tabpanel">
                                <table class="table table-condensed">
                                    <tr>
                                        <th>Played</th>
                                        <td>{{$stat->getPlayed()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Won</th>
                                        <td>{{$stat->getWon()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Lost</th>
                                        <td>{{$stat->getLost()}}</td>
                                    </tr>
                                </table>
                            </div>    
                        @endforeach
                        @foreach ($player->getModeTypes() as $stat)
                            <div class="tab-pane" id="{{$stat->getStatName()}}" role="tabpanel">
                                <table class="table table-condensed">
                                    <tr>
                                        <th>Played</th>
                                        <td>{{$stat->getPlayed()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Won</th>
                                        <td>{{$stat->getWon()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Lost</th>
                                        <td>{{$stat->getLost()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kills</th>
                                        <td>{{$stat->getKills()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Deaths</th>
                                        <td>{{$stat->getDeaths()}}</td>
                                    </tr>     
                                    <tr>
                                        <th>KD</th>
                                        <td>{{$stat->getKillDeathRatio()}}</td>
                                    </tr>
                                </table>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
                @if($user && ($user->uplay_id !== $player->getId()))
                    {!! Form::open(['route' => 'compare', 'method' => 'post', 'id' => 'form-compare', 'class' => 'form-horizontal transparent']) !!}
                
                        {!! Form::hidden('player_id', $player->getId()) !!}
                        {!! Form::submit('Quick Compare', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                @endif
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

@section('scripts')
    $('#stats_tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
    }).first().tab('show');
@endsection
