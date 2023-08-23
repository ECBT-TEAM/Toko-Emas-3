@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.user', ['user' => $data['user']->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                    value="{{ $data['user']->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" value="{{ $data['user']->username }}">
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Cabang</label>
                                <select name="cabang" id="cabang" class="form-control select2">
                                    @foreach ($data['cabang'] as $cabang)
                                        <option value="{{ $cabang->id }}"
                                            {{ $data['user']->cabang_id == $cabang->id ? 'selected' : '' }}>
                                            {{ ucwords($cabang->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    @foreach ($data['role'] as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $data['user']->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Edit</button>
                            <button class="btn btn-warning"
                                onclick="window.location.href='{{ route('master-data.user.index') }}'"
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
                        <h3 class="card-title">List User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Cabang</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ ucwords($data['user']->nama) }}</td>
                                    <td>{{ $data['user']->username }}</td>
                                    <td>{{ ucwords($data['user']->cabang->nama) }}</td>
                                    <td>{{ ucwords($data['user']->role->nama) }}</td>
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
