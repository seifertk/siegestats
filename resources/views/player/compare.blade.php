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
                        </div>

                        <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="mpCasual" data-toggle="collapse" data-target="#mpCasual">
                            <h3><u>MULTIPLAYER - CASUAL</u></h3>
                        </div>

                        <!--Show the multiplayer casual stats fields of both players-->
                        <div class="col-sm-12 collapse" id="mpCasual">
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


                        </div>

                        <div class="col-sm-12 btn" type="button" aria-expanded="true" aria-controls="mpRanked" data-toggle="collapse" data-target="#mpRanked">
                            <h3><u>MULTIPLAYER - RANKED</u></h3>
                        </div>

                        <!--Show the multiplayer ranked stats fields of both players-->
                        <div class="col-sm-12 collapse" id="mpRanked">
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
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection