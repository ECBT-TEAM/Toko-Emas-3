@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kategori Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.kategori') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for=""class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="AT"
                                    value="{{ old('kode') }}">
                                @error('kode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Anting" value="{{ old('nama') }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Tambah</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Kategori Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['kategori'] as $index => $kategori)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ strtoupper($kategori->kode) }}</td>
                                        <td>{{ ucwords($kategori->nama) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('master-data.barang.kategori.edit', ['kategori' => $kategori->id]) }}'"
                                                    type="button" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='{{ route('destroy.kategori', ['kategori' => $kategori->id]) }}'">
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
