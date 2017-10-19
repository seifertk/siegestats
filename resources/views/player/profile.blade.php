@extends('master')

@section('title', 'Player Profile')

@section('content')

<div class="panel panel-default">
    <h2>Player Profile </h2>
    <?php
        $array = json_decode($player, true);
        // Hiding large arrays

        unset($array['progressions']); // stats over the last 30 days
        unset($array['seasonRanks']); // seasonal stats Sherlock
        $loggedinuser = Auth::guard('web')->user()->uplay_id;
        $profileuser = $array['id'];
    ?>
    <pre>
        <h2>Found user id :{{$array['id']}}</h2>
        <h2>Logged in user:{{ Auth::guard('web')->user()->uplay_id }} </h2>
        
        <!--Here we will make the compare link. Using the current user and logged in user. Get their stats, return 2 objects in array. Display-->
        @if($loggedinuser === $profileuser)
            <h1>Matching</h1>
        @else
            <h1>Not matching</h1>
            {!! Form::open(['route' => 'compare', 'method' => 'post', 'id' => 'form-compare', 'class' => 'form-horizontal transparent']) !!}
           
                {!! Form::hidden('player_id', $profileuser) !!}
                {!! Form::submit('Quick Compare', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @endif

        <?php
            echo print_r($array, true);
        ?>
    </pre>
</div>

@endsection