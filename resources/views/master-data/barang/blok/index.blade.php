@extends('layout')
@section('content')
    <div class="container-fluid">
        <button onclick="window.location.href='{{ route('store.blok') }}'" type="button" class="btn btn-info mb-4"><i
                class="fas fa-plus-square"></i> Tambah Blok</button>
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
                                    <th scope="col">Nomor Blok</th>
                                    <th scope="col">Total Kotak</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['blok'] as $index => $blok)
                                    <tr>
                                        <td>Blok {{ $blok->nomor }}</td>
                                        <td class="text-center">{{ $blok->kotak_count }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('master-data.barang.blok.edit', ['blok' => $blok->id]) }}'"
                                                    type="button" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='{{ route('destroy.blok', ['blok' => $blok->id]) }}'">
                                                    <i class="fas fa-trash-alt"></i>
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
