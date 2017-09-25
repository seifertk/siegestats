@extends('master')

@section('title', 'Player Search')

@section('content')
    {!! Form::open(['route' => 'search', 'method' => 'post', 'id' => 'form-search', 'class' => 'form-horizontal transparent']) !!}
        <h1>Search for a Player Account</h1>
        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('name', 'Account Name', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Username']) !!}
                {!! Form::select('platform', ['pc' => 'PC', 'ps4' => 'PS4', 'xbox' => 'Xbox One'], 'pc', ['placeholder' => 'Choose a platform...']); !!}
            </div>
        </div>   
    {!! Form::close() !!}
@endsection
