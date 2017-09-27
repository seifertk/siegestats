@extends ('master')

@section('title', 'Versions')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="header">
                    <img src="{{asset('img/tab_image.png')}}" alt="Logo">
                    <h1>Developer Notes</h1>
                </div>
                <hr/>
                <div class="panel-body">
                    <h3>Version 1.0</h3> 
                    <p>Welcome to Siege Stats v1.0! We have added new functionality to our site! The 
                        following has been added: 
                    </p></br>
                    <ul>
                        <li>Register Page</li>
                        <li>Login Page</li>
                        <li>Versions Page</li>
                        <li>Style update</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection