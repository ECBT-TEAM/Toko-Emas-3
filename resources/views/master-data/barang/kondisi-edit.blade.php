@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kondisi Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.kondisi', ['kondisi' => $data['kondisi']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="AT"
                                    value="{{ $data['kondisi']->kode }}">
                                @error('kode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Nama Kondisi</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Anting" value="{{ $data['kondisi']->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                            <button class="btn btn-warning"
                                onclick="window.location.href='{{ route('master-data.barang.kondisi.index') }}'"
                                type="button">Kembali</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Kondisi Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ strtoupper($data['kondisi']->kode) }}</td>
                                    <td>{{ ucwords($data['kondisi']->nama) }}</td>
                                </tr>
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
