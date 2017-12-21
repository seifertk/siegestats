@extends('master')

@section('title', 'Progressions')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel semi-transparent transparent">
                <div class="header">
                    <h1>My Progression</h1>
                </div>
                <hr/>

                <div class="row">
                    <div class="col-sm-12">
                        <canvas id="rankedProgressionCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    var chartBuilder = new ChartBuilder();
    var rankedProgression = <?php echo json_encode($rankedProgression) ?>;
    var labels = <?php echo json_encode($labels) ?>;

    chartBuilder.buildPlayerRankedProgression(rankedProgression, labels);
@endsection

