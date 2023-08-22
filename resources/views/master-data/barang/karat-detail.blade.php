@extends('layout')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-warning mb-4" onclick="window.location.href='{{ route('master-data.barang.karat.index') }}'"><i
                class="fas fa-angle-double-left"></i> Kembali</button>
        <div class="row row-cols-12">
            <div class="col">
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
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['karat'] as $index => $harga_ref)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ formatRupiah($harga_ref->harga) }}</td>
                                        <td>{{ $harga_ref->status == 1 ? 'Aktif' : 'Non Aktif' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('update.harga_ref.status', ['harga_ref' => $harga_ref->id]) }}'"
                                                    type="button" class="btn btn-success">
                                                    <i class="fas fa-power-off"></i>
                                                </button>
                                                <button data-toggle="modal" data-target="#editHargaRef-{{ $harga_ref->id }}"
                                                    type="button" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='{{ route('destroy.harga_ref', ['harga_ref' => $harga_ref->id]) }}'">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editHargaRef-{{ $harga_ref->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info">
                                                    <h5 class="modal-title">Edit Harga</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('update.harga_ref', ['harga_ref' => $harga_ref->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Harga Refrensi</label>
                                                            <input type="text" class="form-control" id="harga"
                                                                name="harga" placeholder="Rp 20.0000"
                                                                value="{{ formatRupiah($harga_ref->harga) }}">
                                                            @error('harga')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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
        $('#example1').DataTable({
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endpush
