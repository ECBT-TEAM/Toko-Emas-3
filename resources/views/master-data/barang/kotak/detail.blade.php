@extends('layout')
@section('content')
    <div class="container-fluid">
        <button onclick="window.location.href='{{ route('master-data.barang.kotak.index') }}'" type="button"
            class="btn btn-warning mb-4"><i class="fas fa-angle-double-left"></i> Kembali</button>
        <div class="row row-cols-1">
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
                                    <th scope="col">Nomor Kotak</th>
                                    <th scope="col">Total Produk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['kotak'] as $index => $kotak)
                                    <tr>
                                        <td>{{ $kotak->jenis . ' ' . $kotak->nomor }}</td>
                                        <td>{{ $kotak->produk_count }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('master-data.barang.kotak.edit', ['kategori' => $data['kategoriId'], 'kotak' => $kotak->id]) }}'"
                                                    type="button" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='{{ route('destroy.kotak', ['kotak' => $kotak->id]) }}'">
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
