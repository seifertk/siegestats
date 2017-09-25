@extends('master')

@section('title', 'Home')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel transparent">
                <div class="header">
                    <img src="{{asset('img/tab_image.png')}}" alt="Logo">
                    <h1>Welcome to Siege Stats!</h1>
                </div>
                <hr/>
                <div class="panel-body">
                    <h3>What is Siege Stats?</h3> 
                    <p>
                    Siege Stats™ an unofficial, free of charge website that allows players 
                    of Ubisoft’s™ Tom Clancy’s™ Rainbow Six Siege™ to view, compare and analyze 
                    valuable statistics of themselves and fellow players across all platforms 
                    (PC, XBOX™, PlayStation™) to have a satisfying and competitive gameplay 
                    experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection