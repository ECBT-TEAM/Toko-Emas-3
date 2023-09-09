@extends('layout')
@section('content')
    <div class="container-fluid">
        <button onclick="window.location.href='{{ route('produk.index.detail', ['kategori' => $data['kategori']]) }}'"
            type="button" class="btn btn-warning mb-4"><i class="fas fa-angle-double-left"></i> Kembali</button>
        <div class="row row-cols-1">
            <div class="col-12 col-lg-4">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-weight"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Berat Produk</span>
                        <span class="info-box-number"> {{ $data['beratProduk'] }}g</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-weight-hanging"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Berat Wadah</span>
                        <span class="info-box-number"> {{ $data['beratKotak'] }}g</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-balance-scale"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Berat Total</span>
                        <span class="info-box-number"> {{ $data['beratTotal'] }}g</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">List Kotak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Karat</th>
                                    <th scope="col">Sumber</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['produk'] as $index => $produk)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ generateBarcode($produk->barcode) }}" alt="">
                                        </td>
                                        <td>{{ $produk->tipe->kode_tipe . '-' . explode('-', $produk->id)[0] }}</td>
                                        <td>{{ ucwords($produk->tipe->nama) }}</td>
                                        <td class="text-center">{{ $produk->berat . 'g' }}</td>
                                        <td class="text-center">{{ $produk->karat->nama . 'k' }}</td>
                                        <td class="text-center">{{ strtoupper($produk->supplier->nama) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('destroy.produk', ['produk' => $produk->id]) }}'"
                                                    type="button" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
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
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $('#example1').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            paging: true,
        });
    </script>
@endpush
