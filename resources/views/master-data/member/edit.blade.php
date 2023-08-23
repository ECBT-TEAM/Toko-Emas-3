@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.member', ['member' => $data['member']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                    value="{{ $data['member']->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">HP</label>
                                <input type="text" class="form-control" id="hp" name="hp"
                                    placeholder="+62xxxxxxxxxxx" value="{{ $data['member']->hp }}">
                                @error('hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Alamat</label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">{{ $data['member']->alamat }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                            <button class="btn btn-warning"
                                onclick="window.location.href='{{ route('master-data.member.index') }}'"
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
                        <h3 class="card-title">List Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">HP</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ ucwords($data['member']->nama) }}</td>
                                    <td>{{ $data['member']->hp }}</td>
                                    <td>{{ ucwords($data['member']->alamat) }}</td>
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
