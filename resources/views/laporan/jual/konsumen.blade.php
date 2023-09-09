@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-2">
            @foreach ($data as $index => $datas)
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Jual {{ $datas['kategori'] }}</h3>
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
        $('#supplier').select2({
            theme: 'bootstrap4'
        });

        function serachButton() {
            var supplier = $('#supplier').val();
            var url = "{{ route('laporan.jual.supplier', ['supplier' => ':supplier']) }}";
            url = url.replace(':supplier', supplier);

            window.location.href = url
        }

        var data = @json($data);

        data.forEach(function(item, index) {
            var color = generateRandomColors(item.top.length);
            var donutData = {
                labels: item.top.map(item => item.nama),
                datasets: [{
                    data: item.top.map(item => item.total),
                    backgroundColor: color,
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

        function generateRandomColors(count) {
            var randomColors = [];
            for (var i = 0; i < count; i++) {
                var color = tinycolor.random();
                randomColors.push(color.toHexString());
            }
            return randomColors;
        }
    </script>
@endpush
