@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1">
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
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Karat</th>
                                    <th scope="col">Sumber</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['servis'] as $index => $servis)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $servis->produk->tipe->kode_tipe . '-' . explode('-', $servis->produk->id)[0] }}
                                        </td>
                                        <td>{{ $servis->produk->tipe->kategori->nama }}</td>
                                        <td>{{ $servis->produk->berat }}g</td>
                                        <td>{{ $servis->produk->karat->nama }}k</td>
                                        <td>{{ strtoupper($servis->produk->supplier->nama) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="kategori('{{ $servis->produk->tipe->kategori_id }}')"
                                                    class="btn btn-warning" data-toggle="modal"
                                                    data-target="#kotak-{{ $servis->id }}"">
                                                    <i class="fas fa-edit"></i>
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

    @foreach ($data['servis'] as $index => $servis)
        <div class="modal fade" id="kotak-{{ $servis->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">Kondisi Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('update.servis.selesai', ['produk' => $servis->produk_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="form-label">Kotak</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="kotak" id="kotak"
                                    required>
                                </select>
                                @error('kotak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Tambah</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
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

    <script>
        function kategori(id) {
            console.log(id)
            $('#kotak').select2({
                placeholder: 'Silahkan pilih kotak',
                theme: 'bootstrap4',
                ajax: {
                    url: `/api/kotak/` + id,
                    dataType: 'json',
                    processResults: function(res) {
                        console.log(res)
                        if (res.status === 'Found') {
                            return {
                                results: res.data
                            };
                        } else {
                            return {
                                results: [{
                                    id: '0',
                                    text: 'Tidak ditemukan.',
                                    disabled: true
                                }]
                            };
                        }
                    },
                    cache: true
                }
            });
        }
    </script>
@endpush
