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

            <a href="#" style="font-weight: bold" class="navbar-brand dropdown-toggle" data-toggle="collapse" data-target="#statsdropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Siege Stats<span class="caret"></span>
            </a>
            <ul id="statsdropdown" class="dropdown-menu">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('versions') }}">Developer Notes</a></li>
                @if(Auth::user())
                <li><a href="{{ route('player_home') }}">My Profile</a></li>
                @endif
            </ul>

            @if(Auth::user())
                <a href="#" class="navbar-brand dropdown-toggle" data-toggle="collapse" data-target="#userstatsdropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    User Statistics <span class="caret"></span>
                </a>
                <ul id="userstatsdropdown" class="dropdown-menu">
                            <li><a>General</a></li>
                            <li><a href="{{ route('operatorstats') }}">Operators</a></li>
                            <li><a>Weapon Stats</a></li>
                </ul>
            @endif
        </div>    

        <div class="navbar-form navbar-left form-group">
            {!! Form::open(['route' => 'search', 'method' => 'post', 'id' => 'form-search', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                {!! Form::token() !!}
                <div class="input-group">
                    <span class="input-group-btn">
                        <select class="btn btn-default form-control" name="platform">
                            <option value="pc">PC</option>
                            <option value="ps4">PS4</option>
                            <option value="xbox">Xbox One</option>
                        </select>
                    </span>
                    <!-- {!! Form::select('platform', ['pc' => 'PC', 'ps4' => 'PS4', 'xbox' => 'Xbox One'], 'pc', ['class' => 'form-control', 'placeholder' => 'Choose a platform...']); !!} -->
                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Username']) !!}
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        <div class="collapse navbar-collapse navbar-right" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                @if(Auth::user())
                    {!! Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'form-logout']) !!}
                    {!! Form::token() !!}
                        <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown" role="button" ria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user aria-hidden="true""></span> {{ Auth::guard('web')->user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            {!! Form::submit('Logout', ['class' => 'btn']) !!}
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