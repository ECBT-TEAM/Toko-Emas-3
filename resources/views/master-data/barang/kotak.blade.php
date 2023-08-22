@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kotak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.kotak') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for=""class="form-label">Blok</label>
                                <select name="blok" id="blok" class="form-control select2">
                                    @foreach ($data['blok'] as $blok)
                                        <option value="{{ $blok->id }}">Blok {{ $blok->nomor }}</option>
                                    @endforeach
                                </select>
                                @error('blok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control select2">
                                    @foreach ($data['kategori'] as $kategori)
                                        <option value="{{ $kategori->id }}">{{ ucwords($kategori->nama) }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">
                                    Berat Kotak
                                    <small class="text-danger">
                                        <i>Satuan : gram</i>
                                    </small>
                                </label>
                                <input type="number" class="form-control" id="berat" name="berat" placeholder="500"
                                    value="{{ old('berat') }}">
                                @error('berat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Jenis</label>
                                <select name="jenis" id="jenis" class="form-control select2">
                                    <option value="Kotak">Kotak</option>
                                    <option value="Kalung">Kalung</option>
                                </select>
                                @error('jenis')
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
                                @foreach ($data['kotak'] as $index => $kotak)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ strtoupper($kotak->kode) }}</td>
                                        <td>{{ ucwords($kotak->nama) }}</td>
                                        <td>{{ $kotak->kotak->count() }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="window.location.href='#'" type="button"
                                                    class="btn btn-info">
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
        $('.select2').select2({
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
