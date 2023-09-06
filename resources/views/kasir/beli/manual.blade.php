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
            <div class="col">
                <div class="card ">
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                                <button class="btn btn-sm btn-info"
                                                    onclick="window.location.href='{{ route('store.keranjang.produk', ['transaksi' => $data['kodeTransaksi'], 'produk' => $detailTransaksi->produk_id]) }}'">
                                                    <i class="fas fa-check-square"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-danger">
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
                <div class="card ">
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                @foreach ($data['keranjang'] as $keranjang)
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
                                        <td id="hargaBeli">{{ formatRupiah($keranjang->harga) }}</td>
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
        <form action="{{ route('store.transaksi.beli') }}" method="POST">
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
                var hargaJual = rupiahToInt($(this).find('#hargaBeli').text())
                totalHargaJual += hargaJual;
            });
            $('#subtotal').text(formatRupiah(totalHargaJual));
            $('#total').text(formatRupiah(totalHargaJual));
            $('#bayar').val(formatRupiah(totalHargaJual));
        }

        getSubTotal();

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#bayar').on('input', formatAndCalculate);

        // $('#hargaRugi, #harga').on('input', function() {
        //     $(this).val(formatRupiah(rupiahToInt($(this).val())))
        // });

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

        $('#searchTransaksi').click(function() {
            var kodeTransaksi = $('#kodeTransaksi').val();
            var url = "{{ route('kasir.beli.index', ['transaksi' => ':transaksi']) }}";
            url = url.replace(':transaksi', kodeTransaksi);

            window.location.href = url
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
