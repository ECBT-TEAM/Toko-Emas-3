@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Cabang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.cabang', ['cabang' => $data['cabang']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""class="form-label">Nama Cabang</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Cabang" value="{{ $data['cabang']->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Alamat</label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Jl. Diponegoro">{{ $data['cabang']->alamat }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                            <button onclick="window.location.href='{{ route('master-data.cabang.index') }}'"
                                class="btn btn-warning" type="button">Kembali</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Cabang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ ucwords($data['cabang']->nama) }}</td>
                                    <td>{{ ucwords($data['cabang']->alamat) }}</td>
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