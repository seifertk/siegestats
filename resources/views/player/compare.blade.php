@extends('master')

@section('title', 'Player Comparision')

@section('content')

<?php 
    $player1IDX = 0;
    $player2IDX = 1;
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel semi-transparent transparent">
                <div class="header">
                    <h1>Player Compare</h1>
                </div>
                <hr/>
                <div class="panel-body centerText">

                    <div class="row">
                        <div class="col-sm-5">
                            <h2>{{$compareData[$player1IDX]["name"]}}</h2>
                        </div>
                        <div class="col-sm-2">
                            <h1>VS</h1>
                        </div>

                        <div class="col-sm-5">
                            <h2>{{$compareData[$player2IDX]["name"]}}</h2>
                        </div>
                    </div>

                    <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="coreStats" data-toggle="collapse" data-target="#coreStats">
                        <h3><u>CORE STATS</u></h3>
                    </div>

                    <!--Show the core stats fields of both players-->
                    <div class="col-sm-12 collapse" id="coreStats">
                        <!--Player clearance level-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["level"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Clearance</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["level"]}}
                            </div>
                        </div>

                        <!--Player overall win/loss ratio-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["wlRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Win/Loss Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["wlRatio"]}}
                            </div>
                        </div>

                        <!--Player overall kill/death ratio-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["kdRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Kill/Death Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["kdRatio"]}}
                            </div>
                        </div>

                        <!--Player overall matches played-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["matchesPlayed"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Matches Played</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["matchesPlayed"]}}
                            </div>
                        </div>

                        <!--Player overall time played-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["timePlayed"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Time Played</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["timePlayed"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="mpCasual" data-toggle="collapse" data-target="#mpCasual">
                        <h3><u>MULTIPLAYER - CASUAL</u></h3>
                    </div>

                    <!--Show the multiplayer casual stats fields of both players-->
                    <div class="col-sm-12 collapse" id="mpCasual">
                        <!--Players kills in casual-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["casualKills"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Kills</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["casualKills"]}}
                            </div>
                        </div>

                        <!--Players deaths in casual-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["casualDeaths"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Deaths</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["casualDeaths"]}}
                            </div>
                        </div>

                        <!--Players win/loss ratio in casual-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["casualWLRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Win/Loss Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["casualWLRatio"]}}
                            </div>
                        </div>

                        <!--Players kill/death in casual-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["casualKDRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Kill/Death Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["casualKDRatio"]}}
                            </div>
                        </div>

                        <!--Players time played in casual-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["casualTimePlayed"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Time Played</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["casualTimePlayed"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="mpRanked" data-toggle="collapse" data-target="#mpRanked">
                        <h3><u>MULTIPLAYER - RANKED</u></h3>
                    </div>

                    <!--Show the multiplayer ranked stats fields of both players-->
                    <div class="col-sm-12 collapse" id="mpRanked">
                        <!--Players kills in ranked-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["rankedKills"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Kills</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["rankedKills"]}}
                            </div>
                        </div>

                        <!--Players deaths in ranked-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["rankedDeaths"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Deaths</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["rankedDeaths"]}}
                            </div>
                        </div>

                        <!--Players win/loss ratio in ranked-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["rankedWLRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Win/Loss Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["rankedWLRatio"]}}
                            </div>
                        </div>

                        <!--Players kill/death ratio in ranked-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["rankedKDRatio"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Kill/Death Ratio</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["rankedKDRatio"]}}
                            </div>
                        </div>

                        <!--Players time played in ranked-->
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["rankedTimePlayed"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Time Played</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["rankedTimePlayed"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="miscStats" data-toggle="collapse" data-target="#miscStats">
                        <h3><u>MISC</u></h3>
                    </div>

                    <!--Show the misc stats fields of both players-->
                    <div class="col-sm-12 collapse" id="miscStats">
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["bulletsFired"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Bullets Fired</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["bulletsFired"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["bulletsHit"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Bullets Hit</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["bulletsHit"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["gadgetsDestroyed"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Gadgets Destroyed</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["gadgetsDestroyed"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["headshot"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Headshots</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["headshot"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["meleeKills"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Melee Kills</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["meleeKills"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["suicides"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Suicides</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["suicides"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["blindKills"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Blind Kills</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["blindKills"]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                {{$compareData[$player1IDX]["penetrationKills"]}}
                            </div>
                            <div class="col-sm-2">
                                <h4>Penetration Kills</h4>
                            </div>
                            <div class="col-sm-5">
                                {{$compareData[$player2IDX]["penetrationKills"]}}
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
