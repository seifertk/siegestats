<div class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ route('index') }}">
                <b>Siege Stats</b>
            </a>

            @if(Auth::user())
                <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    User Statistics <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                            <li><a>General</a></li>
                            <li><a>Operators</a></li>
                            <li><a>Weapon Stats</a></li>
                </ul>
            @endif
        </div>    

        <div class="collapse navbar-collapse navbar-right" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                @if($user = Auth::user())
                    {!! Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'form-logout']) !!}
                    {!! Form::token() !!}
                        <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown" role="button" ria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user aria-hidden="true""></span> {{ Auth::guard('web')->user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><button type="submit">Logout</button></li>
                        </ul>
                    {!! Form::close() !!}
                @else
                <a href="{{ route('login') }}" class="btn btn-default navbar-btn">Login</a>
                <a href="{{ route('register') }}" class="btn btn-default navbar-btn">Register</a>
                @endif
            </ul>
        </div>


    </div>
</div>