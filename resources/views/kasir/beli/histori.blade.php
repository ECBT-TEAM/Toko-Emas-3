@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Histori Balen / Hari ini</h3>
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
                                                onclick="window.location.href='{{ route('transaksi.beli', ['transaksi' => $transaksi->kode_transaksi]) }}'"><i
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
@endpush
@push('js')
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
    </script>
@endpush
