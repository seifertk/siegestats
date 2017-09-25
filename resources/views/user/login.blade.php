@extends('master')

@section('title', 'Login')

@section('content')
    {!! Form::open(['route' => 'login', 'method' => 'post', 'id' => 'form-login', 'class' => 'form-horizontal transparent']) !!}
    <div class="panel semi-transparent">
        <h1>Login</h1>
        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => '123@example.com']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
