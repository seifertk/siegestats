@extends('master')

@section('title', 'Operator Stats')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel semi-transparent transparent">
                <div class="header">
                    <h1>Operator Stats</h1>
                </div>
                <hr/>
                @foreach ($arr as $key => $value)
                    <div class="panel-body">
                        <img src='{{asset("img/operators/{$key}_badge.png")}}'>                                
                        <h3>{{$value['name']}}</h3>
                        <button style="float:right;margin-top:5%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOP" aria-expanded="false" aria-controls="collapseOP">More statistics</button>

                        <div class="collapse" id="collapseOP">
                            <div class="card card-body">
                                This is just just lorem ipsum trash.This is just just lorem ipsum trash.This is just just lorem ipsum trash.
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection