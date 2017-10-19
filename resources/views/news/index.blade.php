@extends('master')

@section('title', 'News')

@section('content')
    <div class="panel semi-transparent">

    <div class="panel-heading"><h1>Latest News & Updates <small>Page {{$currentPage + 1}}</small></h1></div>

    @include('news._nav')

    </div>

    <div class="panel panel-default semi-transparent" id="newsfeed">
        <div class="row">
                <div class="col-md-8">
                <div class="panel-heading"><h2>News</div>
                @foreach ($content as $item)

                {!! $item !!}

                @endforeach
            
            </div>
            <div class="col-md-4">
                <h2>Updates</h2>
                <ul class='list-group'>
            
                @foreach ($updates as $update)

                {!! $update !!}

                @endforeach
            </ul>
            </div>

        </div>

    </div>

    <div class="panel semi-transparent">
        @include('news._nav')
    </div>
@endsection
