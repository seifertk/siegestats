<div class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">
                Siege Stats
            </a>
        </div>

        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-default navbar-btn">Login</a>
                <a href="{{ route('register') }}" class="btn btn-default navbar-btn">Register</a>
            @endauth
        </div>
    </div>
</div>