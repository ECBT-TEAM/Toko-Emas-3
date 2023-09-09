@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Scan Barcode Surat</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row row-cols-lg-1 row-cols-1">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kode Barcode</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input class="form-control" name="kodeTransaksi" id="kodeTransaksi"
                                                value="{{ $data['kodeTransaksi'] }}">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat" id="searchTransaksi">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                                <button type="button"
                                                    onclick="window.location.href='{{ route('kasir.tukar-tambah.index') }}'"
                                                    class="btn btn-warning btn-flat">
                                                    <i class="fas fa-redo-alt"></i>
                                                </button>
                                            </span>
                                        </div>
                                        @error('kodeBarcode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        @if (!empty($data['kodeTransaksi']))
            <div class="row row-cols-1">
                <div class="col">
                    <div class="card ">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga Rugi</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['detailTransaksi'] as $detailTransaksi)
                                        <tr>
                                            <td>{{ $detailTransaksi->produk->tipe->kode_tipe . '-' . explode('-', $detailTransaksi->produk_id)[0] }}
                                            </td>
                                            <td>
                                                {{ $detailTransaksi->produk->tipe->kategori->first()->nama }}
                                            </td>
                                            <td>
                                                {{ ucwords($detailTransaksi->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $detailTransaksi->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $detailTransaksi->produk->karat->nama }}k</span>
                                            </td>
                                            <td>{{ formatRupiah($detailTransaksi->produk->harga_rugi) }}</td>
                                            <td class="hargaBeli">{{ formatRupiah($detailTransaksi->harga) }}</td>
                                            <td>
                                                @if ($detailTransaksi->produk->status_id == 3)
                                                    <button class="btn btn-sm btn-info" type="button"
                                                        onclick="window.location.href='{{ route('store.keranjang.produk', ['kategori' => 'tukar-tambah', 'transaksi' => $data['kodeTransaksi'], 'produk' => $detailTransaksi->produk_id]) }}'">
                                                        <i class="fas fa-check-square"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-danger" type="button">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                @endif
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
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">List Tukar Masuk</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga Beli</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['keranjangMasuk'] as $keranjang)
                                        <tr>
                                            <td>{{ $keranjang->produk->tipe->kode_tipe . '-' . explode('-', $keranjang->produk_id)[0] }}
                                            </td>
                                            <td>
                                                {{ $keranjang->produk->tipe->kategori->first()->nama }}
                                            </td>
                                            <td>
                                                {{ ucwords($keranjang->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $keranjang->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $keranjang->produk->karat->nama }}k</span>
                                            </td>
                                            <td id="hargaBeli">
                                                {{ formatRupiah($keranjang->harga - ($keranjang->produk->service->first()->harga ?? 0)) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="window.location.href='{{ route('destroy.keranjang', ['keranjang' => $keranjang->id]) }}'">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button data-toggle="modal" data-target="#kerusakan-{{ $keranjang->id }}"
                                                    class="btn btn-sm btn-warning" type="button">
                                                    <i class="fas fa-toolbox"></i>
                                                </button>
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
                <div class="col text-center">
                    <button class="btn btn-lg btn-success mb-3 col-lg-2 col-12" data-toggle="modal"
                        data-target="#modalTambahTukar">Tambah Produk Tukar</button>
                </div>
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">List Tukar Keluar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga Rugi</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['keranjangKeluar'] as $keranjang)
                                        <tr>
                                            <td>{{ $keranjang->produk->tipe->kode_tipe . '-' . explode('-', $keranjang->produk_id)[0] }}
                                            </td>
                                            <td>
                                                {{ $keranjang->produk->tipe->kategori->first()->nama }}
                                            </td>
                                            <td>
                                                {{ ucwords($keranjang->produk->tipe->nama) }}
                                                <span class="badge badge-info">Berat:
                                                    {{ $keranjang->produk->berat }}g</span>
                                                <span class="badge badge-warning">Karat:
                                                    {{ $keranjang->produk->karat->nama }}k</span>
                                            </td>
                                            <td>
                                                {{ formatRupiah($keranjang->produk->harga_rugi) }}
                                            </td>
                                            <td id="hargaJual">
                                                {{ formatRupiah($keranjang->harga) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="window.location.href='{{ route('destroy.keranjang', ['keranjang' => $keranjang->id]) }}'">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button data-toggle="modal" data-target="#kerusakan-{{ $keranjang->id }}"
                                                    class="btn btn-sm btn-warning" type="button">
                                                    <i class="fas fa-toolbox"></i>
                                                </button>
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
            <form action="{{ route('store.transaksi.beli', ['transaksi' => $data['kodeTransaksi']]) }}" method="POST">
                <div class="row row-cols-1">
                    @csrf
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                                            value="{{ date('d/m/y H:i:s') }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Seller</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2bs4" style="width: 100%;" name="seller"
                                            id="seller">
                                            @foreach ($data['seller'] as $seller)
                                                <option value="{{ $seller->id }}">{{ $seller->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('seller')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                        <select class="form-control select2bs4" style="width: 100%;" name="metodeBayar"
                                            id="metodeBayar">
                                            <option value="Cash">Cash</option>
                                            <option value="Debit">Debit</option>
                                        </select>
                                        @error('metodeBayar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row" id="formBayar">
                                    <label class="col-sm-2 col-form-label">Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bayar" id="bayar"
                                            value="Rp 0">
                                        @error('bayar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row d-none" id="formNorek">
                                    <label class="col-sm-2 col-form-label">Nomor Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="norek" id="norek"
                                            placeholder="Nomor Rekening">
                                        @error('norek')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <button type="button" class="btn btn-lg btn-block btn-warning">
                            <i class="fas fa-redo-alt"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-lg btn-block btn-success">
                            <i class="fas fa-paper-plane"></i>
                            Proses
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
                                            <tr class="text-danger h2">
                                                <th style="width:28%">Kembali</th>
                                                <td style="width:1%">:</td>
                                                <td><strong id="kembali">Rp 0</strong></td>
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
            </form>
        @endif
    </div>
    @foreach ($data['keranjangMasuk'] as $keranjang)
        <div class="modal fade" id="kerusakan-{{ $keranjang->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">Kondisi Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('store.service', ['produk' => $keranjang->produk_id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="form-label">Status</label>
                                <select class="form-control" style="width: 100%;" name="status" id="status"
                                    required>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Sedang">Rusak Sedang</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Kondisi</label>
                                <select multiple="multiple" class="form-control select2bs4" style="width: 100%;"
                                    name="kondisi[]" id="kondisi" required>
                                    @foreach ($data['kondisi'] as $seller)
                                        <option value="{{ $seller->id }}"
                                            {{ in_array($seller->id, $keranjang->produk->service->pluck('kondisi_id')->toArray()) ? 'selected' : '' }}>
                                            {{ $seller->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Potongan Harga Rusak</label>
                                <input type="text" class="form-control" name="hargaRusak" id="hargaRusak"
                                    value="{{ formatRupiah($keranjang->produk->service->first()->harga ?? 0) }}">
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
    <div class="modal fade" id="modalTambahTukar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Produk Tukar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.keranjang') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row row-cols-lg-1 row-cols-1">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kode Barcode</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input class="form-control" name="searchBarcode" id="searchBarcode"
                                                value="{{ old('kodeBarcode') }}">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat" id="searchProduk">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                        @error('searchBarcode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="model" id="model"
                                            readonly>
                                        @error('model')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">
                                        Berat
                                        <small>
                                            <i>Satuan : gram(g)</i>
                                        </small>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="berat" id="berat"
                                            readonly>
                                        @error('berat')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Karat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="karat" id="karat"
                                            readonly>
                                        @error('karat')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Ref</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2bs4" style="width: 100%;" name="hargaRef"
                                            id="hargaRef">
                                        </select>
                                        @error('hargaRef')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="qty" id="qty"
                                                value="1" readonly>
                                            <span class="input-group-append">
                                                <button type="button" id="totalStok" name="totalStok"
                                                    class="btn btn-success btn-flat" value="20">
                                                    Stok : 0
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Total Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="harga" id="harga">
                                        @error('harga')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Rugi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="hargaRugi" id="hargaRugi">
                                        @error('hargaRugi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="kodeBarcode" id="kodeBarcode">
                        <input type="hidden" name="jenisTransaksi" id="jenisTransaksi" value="3">
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
@endsection
@push('css')
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function handleAjaxRequest(url, successCallback) {
            $.ajax({
                url: url,
                dataType: 'json',
                success: successCallback,
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'API request error';
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage,
                        confirmButtonColor: '#17a2b8',
                    });
                }
            });
        }

        function searchProductByBarcode(kodeBarcode) {
            if (kodeBarcode != '') {
                var url = "{{ route('searchProduk', ['kodeProduk' => ':kodeProduk']) }}";
                url = url.replace(':kodeProduk', kodeBarcode);
                handleAjaxRequest(url, function(data) {
                    if (data.status == 'Found') {
                        var hargaRefSelect = $('#hargaRef');
                        hargaRefSelect.empty();
                        $.each(data.data.harga_ref, function(index, item) {
                            hargaRefSelect.append(new Option(formatRupiah(rupiahToInt(item)), item));
                        });
                        hargaRefSelect.trigger('change');
                        $('#model').val(data.data.tipe);
                        $('#berat').val(data.data.berat);
                        $('#karat').val(data.data.karat);
                        $('#harga').val(formatRupiah($('#hargaRef').val() * data.data.berat));
                        $('#kodeBarcode').val(kodeBarcode);

                        $('#searchBarcode').val('');
                        $('#searchBarcode').focus();
                    } else {
                        var hargaRefSelect = $('#hargaRef');
                        hargaRefSelect.empty();
                        $('#searchBarcode').val('');
                        $('#model').val('');
                        $('#berat').val('');
                        $('#karat').val('');
                        $('#harga').val('');
                        $('#kodeBarcode').val(kodeBarcode);
                        $('#searchBarcode').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Produk tidak ditemukan.',
                            confirmButtonColor: '#17a2b8',
                        });
                    }
                });
            }
        }

        function formatAndCalculate() {
            var inputValue = rupiahToInt($('#bayar').val());
            var total = rupiahToInt($('#total').text());
            $('#bayar').val(formatRupiah(inputValue));
            $('#kembali').text(formatRupiah(inputValue - total));
        }

        function getSubTotal() {
            var totalHargaBeli = 0;
            var totalHargaJual = 0;
            $('#example1 tbody tr').each(function() {
                var hargaBeli = rupiahToInt($(this).find('#hargaBeli').text())
                totalHargaBeli += hargaBeli;
            });
            $('#example2 tbody tr').each(function() {
                var hargaJual = rupiahToInt($(this).find('#hargaJual').text())
                totalHargaJual += hargaJual;
            });
            var totalHarga = totalHargaBeli - totalHargaJual
            $('#subtotal').text(formatRupiah(totalHarga));
            $('#total').text(formatRupiah(totalHarga));
            $('#bayar').val(formatRupiah(Math.abs(totalHarga)));
        }

        getSubTotal();

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#bayar').on('input', formatAndCalculate);

        $('#harga, #hargaRugi, #harga').on('input', function() {
            $(this).val(formatRupiah(rupiahToInt($(this).val())))
        });

        $('#metodeBayar').on('change', function() {
            var formBayar = $('#formBayar');
            var formNorek = $('#formNorek');

            if ($(this).val() == 'Cash') {
                formBayar.removeClass('d-none');
                formNorek.addClass('d-none');
            } else if ($(this).val() == 'Debit') {
                formBayar.addClass('d-none');
                formNorek.removeClass('d-none');
            } else {
                formBayar.addClass('d-none');
                formNorek.addClass('d-none');
            }
        });

        $('#kodeTransaksi').focus();

        $('#kodeTransaksi').on('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                var kodeTransaksi = $(this).val();
                var url = "{{ route('kasir.tukar-tambah.index', ['transaksi' => ':transaksi']) }}";
                url = url.replace(':transaksi', kodeTransaksi);
                window.location.href = url
            }
        });

        $('#searchTransaksi').click(function() {
            var kodeTransaksi = $('#kodeTransaksi').val();
            var url = "{{ route('kasir.tukar-tambah.index', ['transaksi' => ':transaksi']) }}";
            url = url.replace(':transaksi', kodeTransaksi);

            window.location.href = url
        });

        $('#searchBarcode').on('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                var kodeBarcode = $(this).val();
                searchProductByBarcode(kodeBarcode);
            }
        });

        $('#searchProduk').click(function() {
            var kodeBarcode = $('#searchBarcode').val();
            searchProductByBarcode(kodeBarcode);
        });
    </script>
@endpush
