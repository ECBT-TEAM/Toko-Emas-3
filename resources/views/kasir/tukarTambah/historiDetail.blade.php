@extends('layout')
@section('content')
    <div class="container-fluid">
        <button onclick="window.location.href='{{ route('kasir.jual.histori') }}'" type="button"
            class="btn btn-warning mb-4"><i class="fas fa-angle-double-left"></i> Kembali</button>
        <div class="row row-cols-1">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Tukar Masuk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Kerusakan</th>
                                    <th scope="col">Harga Beli</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['transaksi']->transaksiDetail as $transaksi)
                                    @if ($transaksi->status == 1)
                                        <tr>
                                            <td>
                                                {{ $transaksi->produk->tipe->kode_tipe . '-' . explode('-', $transaksi->produk->id)[0] }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->kategori->first()->nama) }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $transaksi->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $transaksi->produk->karat->nama }}k</span>
                                            </td>
                                            <td>
                                                <ol>
                                                    @foreach ($transaksi->produk->service as $kondisi)
                                                        <li>{{ $kondisi->kondisi->nama }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td id="hargaBeli">{{ formatRupiah($transaksi->harga) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Tukar Keluar</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga Rugi</th>
                                    <th scope="col">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['transaksi']->transaksiDetail as $transaksi)
                                    @if ($transaksi->status == 2)
                                        <tr>
                                            <td>
                                                {{ $transaksi->produk->tipe->kode_tipe . '-' . explode('-', $transaksi->produk->id)[0] }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->kategori->first()->nama) }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $transaksi->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $transaksi->produk->karat->nama }}k</span>
                                            </td>
                                            <td>{{ formatRupiah($transaksi->produk->harga_rugi) }}</td>
                                            <td id="hargaJual">{{ formatRupiah($transaksi->harga) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Pindah Nota</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga Rugi</th>
                                    <th scope="col">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['transaksi']->transaksiDetail as $transaksi)
                                    @if ($transaksi->status == 4)
                                        <tr>
                                            <td>
                                                {{ $transaksi->produk->tipe->kode_tipe . '-' . explode('-', $transaksi->produk->id)[0] }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->kategori->first()->nama) }}
                                            </td>
                                            <td>
                                                {{ ucwords($transaksi->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $transaksi->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $transaksi->produk->karat->nama }}k</span>
                                            </td>
                                            <td>{{ formatRupiah($transaksi->produk->harga_rugi) }}</td>
                                            <td>{{ formatRupiah($transaksi->harga) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
            <div class="col">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ ucwords($data['transaksi']->member->nama) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Hp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['transaksi']->member->hp }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" readonly>{{ ucwords($data['transaksi']->member->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal" id="tanggal"
                                    value="{{ $data['transaksi']->created_at }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Seller</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ ucwords($data['transaksi']->user->nama) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-lg-6">
                <div class="card ">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Metode Bayar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ $data['transaksi']->metode_pembayaran }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row {{ $data['transaksi']->metode_pembayaran != 'Cash' ? '' : 'd-none' }}">
                            <label class="col-sm-2 col-form-label">Seller</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['transaksi']->norek }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <button type="button" class="btn btn-lg btn-block btn-warning">
                    <i class="fas fa-print"></i>
                    Print Nota
                </button>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:28%">Subtotal</th>
                                        <td style="width:1%">:</td>
                                        <td id="subtotal">Rp 0</td>
                                    </tr>
                                    <tr>
                                        <th style="width:28%">Pembulatan</th>
                                        <td style="width:1%">:</td>
                                        <td id="subtotal"></td>
                                    </tr>
                                    <tr class="text-success h2">
                                        <th style="width:28%">Total</th>
                                        <td style="width:1%">:</td>
                                        <td><strong id="total">Rp 0</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
        var totalHargaJual = 0;
        var totalHargaBeli = 0;
        $('#example2 tbody tr').each(function() {
            var hargaJual = rupiahToInt($(this).find('#hargaJual').text())
            totalHargaJual += hargaJual;
        });
        $('#example1 tbody tr').each(function() {
            var hargaBeli = rupiahToInt($(this).find('#hargaBeli').text())
            totalHargaBeli += hargaBeli;
        });
        var total = totalHargaBeli - totalHargaJual
        $('#subtotal').text(formatRupiah(total));
        $('#total').text(formatRupiah(total));
    </script>
@endpush
