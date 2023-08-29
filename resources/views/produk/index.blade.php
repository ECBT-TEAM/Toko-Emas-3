@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Kotak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kode Kategori</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Total Kotak</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['kotak'] as $index => $kategori)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ strtoupper($kategori->kode) }}</td>
                                        <td>{{ ucwords($kategori->nama) }}</td>
                                        <td>{{ $kategori->kotak_count }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('produk.index.detail', ['kategori' => $kategori->id]) }}'"
                                                    type="button" class="btn btn-info">
                                                    <i class="far fa-eye"></i>
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
