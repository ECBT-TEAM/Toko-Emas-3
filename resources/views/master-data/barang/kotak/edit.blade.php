@extends('layout')
@section('content')
    <div class="container-fluid">
        <button
            onclick="window.location.href='{{ route('master-data.barang.kotak.detail', ['kategoriId' => $data['kategoriId']]) }}'"
            type="button" class="btn btn-warning mb-4"><i class="fas fa-angle-double-left"></i>
            Kembali</button>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Kotak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.kotak', ['kotak' => $data['kotak']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""class="form-label">Blok</label>
                                <select name="blok" id="blok" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($data['blok'] as $blok)
                                        <option value="{{ $blok->id }}"
                                            {{ $blok->id == $data['kotak']->blok_id ? 'selected' : '' }}>
                                            Blok
                                            {{ $blok->nomor }}</option>
                                    @endforeach
                                </select>
                                @error('blok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($data['kategori'] as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $kategori->id == $data['kotak']->kategori_id ? 'selected' : '' }}>
                                            {{ ucwords($kategori->nama) }}</option>
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
                                    value="{{ $data['kotak']->berat }}">
                                @error('berat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Jenis</label>
                                <select name="jenis" id="jenis" class="form-control select2bs4" style="width: 100%;">
                                    <option value="Kotak" {{ 'Kotak' == $data['kotak']->jenis ? 'selected' : '' }}>Kotak
                                    </option>
                                    <option value="Patung" {{ 'Patung' == $data['kotak']->jenis ? 'selected' : '' }}>Patung
                                    </option>
                                </select>
                                @error('jenis')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Nomor</label>
                                <input type="number" class="form-control" name="nomor" id="nomor"
                                    value="{{ $data['kotak']->nomor }}">
                                @error('nomor')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                        </form>
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
