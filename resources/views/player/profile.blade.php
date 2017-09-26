@extends('master')

@section('title', 'Player Profile')

@section('content')

<div class="panel panel-default">
    <h2>Player Profile </h2>
    <pre>
        <?php
            $array = json_decode($player, true);
            echo print_r($array, true);
        ?>
    </pre>
</div>

@endsection