@extends('master')

@section('content')
    <h1>Register</h1>
    <form class="form-horizontal" role="form" method="POST" action="/login">
    <div class="form-group">
            <label for="firstname" class="col-md-4 control-label">First Name</label>
            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control" name="firstname" required>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-md-4 control-label">Last Name</label>
            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control" name="lastname" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
@endsection
