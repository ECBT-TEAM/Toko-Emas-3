@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Karat Karat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.karat') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for=""class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="IBR"
                                    value="{{ old('kode') }}">
                                @error('kode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Jenis karat</label>
                                <input type="number" class="form-control" id="nama" name="nama" placeholder="16"
                                    value="{{ old('nama') }}">
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
            <div class="col-12 col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Harga Refrensi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.harga_ref') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for=""class="form-label">Karat</label>
                                <select name="karat" id="karat" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($data['karat'] as $karat)
                                        <option value="{{ $karat->id }}">
                                            {{ strtoupper($karat->kode) . ' - ' . $karat->nama }}k
                                        </option>
                                    @endforeach
                                </select>
                                @error('karat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Harga Refrensi</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    placeholder="Rp 20.000" value="{{ old('harga') }}">
                                @error('harga')
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
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Jenis Karat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Jenis Karat</th>
                                    <th scope="col">Harga Min</th>
                                    <th scope="col">Harga Max</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['karat'] as $index => $karat)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ strtoupper($karat->kode) }}</td>
                                        <td>{{ ucwords($karat->nama) }}k</td>
                                        <td>{{ formatRupiah($karat->harga_ref->min('harga')) }}</td>
                                        <td>{{ formatRupiah($karat->harga_ref->max('harga')) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('master-data.barang.karat.detail', ['karat' => $karat->id]) }}'"
                                                    type="button" class="btn btn-success">
                                                    <i class="fas fa-tags"></i>
                                                </button>
                                                <button
                                                    onclick="window.location.href='{{ route('master-data.barang.karat.edit', ['karat' => $karat->id]) }}'"
                                                    type="button" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='{{ route('destroy.karat', ['karat' => $karat->id]) }}'">
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
        $("#harga").on("input", function() {
            var inputValue = $(this).val();
            var numericValue = rupiahToInt(inputValue);
            var formattedRupiah = formatRupiah(numericValue);
            $(this).val(formattedRupiah);
        });
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
