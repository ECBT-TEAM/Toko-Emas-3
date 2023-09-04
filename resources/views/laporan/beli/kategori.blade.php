@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Jual per Kategori</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <canvas id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Jual per Kategori</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ url('template') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ url('template') }}/plugins/tinycolor/tinycolor.js"></script>
    <script>
        function generateRandomColors(count) {
            var randomColors = [];
            for (var i = 0; i < count; i++) {
                var color = tinycolor.random();
                randomColors.push(color.toHexString());
            }
            return randomColors;
        }

        var data = @json($data['piechart']);
        var color = generateRandomColors(data.length)

        var donutData = {
            labels: data.map(item => item.kategori),
            datasets: [{
                data: data.map(item => item.total),
                backgroundColor: color,
            }]
        };

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        new Chart(pieChartCanvas, {
            type: 'pie',
            data: donutData,
            options: pieOptions
        });


        var areaChartData = {
            labels: @json($data['barchart']['labels']),
            datasets: @json($data['barchart']['datasets'])
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)

        barChartData.datasets.forEach(function(dataset, index) {
            dataset.backgroundColor = color[index]
        });


        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    </script>
@endpush
