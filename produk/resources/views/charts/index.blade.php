@extends('layouts.app')

@section('title', 'Charts')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Charts
            </div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bar Chart
            </div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <canvas class="chart" id="bar-chart" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Doughnut Chart
            </div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <canvas class="chart" id="doughnut-chart" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('Lumino/js/chart.min.js') }}"></script>
<script src="{{ asset('Lumino/js/chart-data.js') }}"></script>
<script>
    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        }, {
            label: "My Second dataset",
            fillColor: "rgba(48, 164, 255, 0.2)",
            strokeColor: "rgba(48, 164, 255, 1)",
            pointColor: "rgba(48, 164, 255, 1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(48, 164, 255, 1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }]
    };

    var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        }, {
            fillColor: "rgba(48, 164, 255, 0.5)",
            strokeColor: "rgba(48, 164, 255, 0.8)",
            highlightFill: "rgba(48, 164, 255, 0.75)",
            highlightStroke: "rgba(48, 164, 255, 1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }]
    };

    var doughnutData = [{
        value: 300,
        color: "#30a5ff",
        highlight: "#62b9fb",
        label: "Blue"
    }, {
        value: 50,
        color: "#ffb53e",
        highlight: "#fac878",
        label: "Orange"
    }, {
        value: 100,
        color: "#1ebfae",
        highlight: "#3cdfce",
        label: "Teal"
    }, {
        value: 120,
        color: "#f9243f",
        highlight: "#f6495f",
        label: "Red"
    }];

    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById("line-chart");
        if (ctx) {
            ctx = ctx.getContext("2d");
            var myLineChart = new Chart(ctx).Line(lineChartData, {
                responsive: true
            });
        }

        var ctx2 = document.getElementById("bar-chart");
        if (ctx2) {
            ctx2 = ctx2.getContext("2d");
            var myBarChart = new Chart(ctx2).Bar(barChartData, {
                responsive: true
            });
        }

        var ctx3 = document.getElementById("doughnut-chart");
        if (ctx3) {
            ctx3 = ctx3.getContext("2d");
            var myDoughnutChart = new Chart(ctx3).Doughnut(doughnutData, {
                responsive: true
            });
        }
    });
</script>
@endpush
