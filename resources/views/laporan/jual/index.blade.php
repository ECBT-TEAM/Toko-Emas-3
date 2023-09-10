@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                <div class="card card-info h-100">
                    <div class="card-header">
                        <h3 class="card-title">Filter by Tanggal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""class="form-label">Tanggal</label>
                            <div class="input-group">
                                <input type="text" class="form-control float-right" name="tanggal" id="tanggal">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" id="cariButton">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-flat"
                                        onclick="window.location.href='{{ route('laporan.jual.index') }}'">
                                        <i class="fas fa-undo-alt"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="card card-info h-100">
                    <div class="card-header">
                        <h3 class="card-title">Cari Kode Transaksi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for=""class="form-label">Kode Transaksi</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="kodeTransaksi" id="kodeTransaksi">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat" id="cariTransaksi">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Histori Jual</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Nama Pembeli</th>
                                    <th scope="col">Nama Seller</th>
                                    <th scope="col">Tanggal Beli</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['transaksi'] as $index => $transaksi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaksi->kode_transaksi }}</td>
                                        <td>{{ ucwords($transaksi->member->nama) }}</td>
                                        <td>{{ ucwords($transaksi->user->nama) }}</td>
                                        <td>{{ $transaksi->created_at }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                onclick="window.location.href='{{ route('transaksi.jual', ['transaksi' => $transaksi->kode_transaksi]) }}'"><i
                                                    class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ url('template') }}/plugins/daterangepicker/daterangepicker.css">
@endpush
@push('js')
    <!-- InputMask -->
    <script src="{{ url('template') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('template') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{ url('template') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#example1').DataTable({
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#tanggal').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })

        $('#cariButton').click(function() {
            var dateRange = $('#tanggal').val();

            var dateRangeParts = dateRange.split(' - ');
            var tanggalAwal = dateRangeParts[0];
            var tanggalAkhir = dateRangeParts[1];

            var timestampAwal = new Date(tanggalAwal).getTime() / 1000;
            var timestampAkhir = new Date(tanggalAkhir).getTime() / 1000;

            var url =
                "{{ route('laporan.jual.cari', ['awal' => ':awal', 'akhir' => ':akhir']) }}";
            url = url.replace(':awal', timestampAwal);
            url = url.replace(':akhir', timestampAkhir);

            window.location.href = url;
        });

        $('#cariTransaksi').click(function() {
            var kodeTransaksi = $('#kodeTransaksi').val();

            var url =
                "{{ route('transaksi.jual', ['transaksi' => ':transaksi']) }}";
            url = url.replace(':transaksi', kodeTransaksi);

            window.location.href = url;
        });
    </script>
@endpush
