@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Keranjang</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.keranjang') }}" method="POST">
                            @csrf
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
                                            @error('kodeBarcode')
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
                                    <button type="submit" class="btn btn-info btn-block">
                                        <i class="fas fa-shopping-cart"></i>
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="kodeBarcode" id="kodeBarcode">
                            <input type="hidden" name="jenisTransaksi" id="jenisTransaksi" value="1">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col">
                <div class="card ">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped">
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
                                @foreach ($data['keranjang'] as $keranjang)
                                    <tr>
                                        <td>{{ $keranjang->produk->tipe->kode_tipe . '-' . explode('-', $keranjang->produk_id)[0] }}
                                        </td>
                                        <td>
                                            {{ $keranjang->produk->tipe->kategori->nama }}
                                        </td>
                                        <td>
                                            {{ ucwords($keranjang->produk->tipe->nama) }}
                                            <span class="badge badge-info">Berat:
                                                {{ $keranjang->produk->berat }}g</span>
                                            <span class="badge badge-warning">Karat:
                                                {{ $keranjang->produk->karat->nama }}k</span>
                                        </td>
                                        <td>{{ formatRupiah($keranjang->produk->harga_rugi) }}</td>
                                        <td id="hargaJual">{{ formatRupiah($keranjang->harga) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="window.location.href='{{ route('destroy.keranjang', ['keranjang' => $keranjang->id]) }}'">
                                                <i class="fas fa-trash"></i>
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
        <form action="{{ route('store.transaksi.jual') }}" method="POST">
            @csrf
            <div class="row row-cols-1">
                <div class="col">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hp</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hp" id="hp"
                                            placeholder="+6282139900446" value="{{ old('hp') }}">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" id="searchMember">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    @error('hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ old('nama') }}" placeholder="Nama Lengkap">
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
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

        function formatAndCalculate() {
            var inputValue = rupiahToInt($('#bayar').val());
            var total = rupiahToInt($('#total').text());
            $('#bayar').val(formatRupiah(inputValue));
            $('#kembali').text(formatRupiah(inputValue - total));
        }

        function getSubTotal() {
            var totalHargaJual = 0;
            $('#example1 tbody tr').each(function() {
                var hargaJual = rupiahToInt($(this).find('#hargaJual').text())
                totalHargaJual += hargaJual;
            });
            $('#subtotal').text(formatRupiah(totalHargaJual));
            $('#total').text(formatRupiah(totalHargaJual));
            $('#bayar').val(formatRupiah(totalHargaJual));
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

        getSubTotal();

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#bayar').on('input', formatAndCalculate);

        $('#hargaRugi, #harga').on('input', function() {
            $(this).val(formatRupiah(rupiahToInt($(this).val())))
        });

        $('#hargaRef').on('change', function() {
            $('#harga').val(formatRupiah($(this).val() * $('#berat').val()));
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

        $('#searchMember').click(function() {
            var hp = $('#hp').val();
            var url = "{{ route('searchMember', ['member' => ':member']) }}";
            url = url.replace(':member', hp);
            handleAjaxRequest(url, function(data) {
                if (data.status == 'Found') {
                    $('#nama').val(data.data.nama);
                    $('#alamat').val(data.data.alamat);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Member tidak ditemukan.',
                        confirmButtonColor: '#17a2b8',
                    });
                }
            });
        });
    </script>
@endpush
