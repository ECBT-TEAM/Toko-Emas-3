@extends('layout')
@section('content')
    <div class="container-fluid">
        <button onclick="window.location.href='{{ route('store.blok') }}'" type="button" class="btn btn-info mb-4"><i
                class="fas fa-plus-square"></i> Tambah Blok</button>
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Blok</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.blok', ['blok' => $data['blok']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Nomor</label>
                                <input type="number" class="form-control" name="nomor" id="nomor" placeholder="1"
                                    value="{{ $data['blok']->nomor }}">
                                @error('nomor')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                            <button class="btn btn-warning"
                                onclick="window.location.href='{{ route('master-data.barang.blok.index') }}'"
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
                        <h3 class="card-title">List Blok</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor Blok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Blok {{ $data['blok']->nomor }}</td>
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
