@extends('master')

@section('title', 'Operator Stats')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel semi-transparent transparent">
                <div class="header">
                    <h1>Operator Stats</h1>
                </div>
                <hr/>
                @foreach ($arr as $key => $value)

                <!--There is no kill attribute if it is 0. We need to check if value exists otherwise return 0. This will be resolved with a model in future-->
                <?php 
                    if(isset($value['kills'])): 
                        $kills = $value['kills'];
                    else:
                        $kills = 0;
                    endif;
                ?>

                <!--On hover show the view stats button-->
                    <div class="panel-body">
                        <img src='{{asset("img/operators/{$key}_badge.png")}}'>                                
                        <h3>{{$value['name']}}</h3>
                        <button style="float:right;margin-top:5%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{$key}">View statistics</button>

                        <div class="col-sm-12 collapse" id="collapse{{$key}}">
                            <div class="row">
                                <div class="col-sm-1">
                                    Won: {{$value['won']}}
                                </div>

                                <div class="col-sm-1">
                                    Lost: {{$value['lost']}}
                                </div>

                                <div class="col-sm-1">
                                    Kills: {{$kills}}
              
                                </div>      
                                <div class="col-sm-1">
                                    Deaths: {{$value['deaths']}}
                                </div>

                                <div class="col-sm-2">
                                    Win Ratio: 
                                    <?php
                                        echo number_format((float)$value['won'] / ($value['won'] + $value['lost']) * 100,2,'.','')."%";
                                    ?>
                                </div>

                                <div class="col-sm-2">
                                    K/D Ratio: 
                                    <?php
                                    if(isset($value['kills'])):
                                        if($value['deaths'] > 1):
                                            echo number_format((float)$value['kills'] / $value['deaths'] ,2,'.','')."%";
                                        else:
                                            echo $value['kills'];
                                        endif;
                                    else:
                                        echo 0;
                                    endif;
                                    ?>
                                </div>

                                <!--Time is in seconds. Convert to hours with seconds appended--> 
                                <div class="col-sm-3">
                                    Time Played (HH:mm):
                                    <?php
                                        echo gmdate("H:i", $value['timePlayed']);
                                    ?>
                                    
                                </div>                              
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection