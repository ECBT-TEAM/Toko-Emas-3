@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-2">
            @foreach ($data['piechart'] as $index => $piechart)
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Jual {{ $piechart['kategori'] }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <canvas id="pieChart{{ $index }}"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ url('template') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ url('template') }}/plugins/tinycolor/tinycolor.js"></script>
    <script>
        var data = @json($data['piechart']);

        data.forEach(function(item, index) {
            var color = generateRandomColor();
            var donutData = {
                labels: item.tipe.map(item => item.nama),
                datasets: [{
                    data: item.tipe.map(item => item.total),
                    backgroundColor: [color, 'lightgray'],
                }]
            };
            var pieChartCanvas = $('#pieChart' + index)[0].getContext('2d');

            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            new Chart(pieChartCanvas, {
                type: 'pie',
                data: donutData,
                options: pieOptions
            });
        });

        function generateRandomColor() {
            return '#' + (Math.random().toString(16) + '0000000').slice(2, 8);
        }
    </script>
@endpush
