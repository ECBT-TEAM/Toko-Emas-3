@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Blok</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['servis'] as $index => $servis)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $servis->produk->tipe->kategori->nama }}</td>
                                        <td>{{ $servis->produk->tipe->nama }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info"
                                                    onclick="window.location.href='{{ route('update.servis', ['produk' => $servis->produk_id]) }}'">
                                                    <i class="fas fa-clipboard-check"></i>
                                                </button>
                                            </div>
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
        $('#example1').DataTable({
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endpush
