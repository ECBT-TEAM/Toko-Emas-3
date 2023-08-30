@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.produk') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    @foreach ($data['kategori'] as $kategori)
                                        <option value="{{ $kategori->id }}">{{ ucwords($kategori->nama) }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Model</label>
                                <select name="model" id="model" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    <option value="0" selected disabled>Silahkan pilih kategori</option>
                                </select>
                                @error('model')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Karat</label>
                                <select name="karat" id="karat" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    @foreach ($data['karat'] as $karat)
                                        <option value="{{ $karat->id }}">
                                            {{ $karat->nama }}k
                                        </option>
                                    @endforeach
                                </select>
                                @error('karat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Sumber</label>
                                <select name="sumber" id="sumber" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    @foreach ($data['supplier'] as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ strtoupper($supplier->pabrik) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Kotak</label>
                                <select name="kotak" id="kotak" class="form-control select2bs4" style="width: 100%;"
                                    required>
                                    <option value="0" selected disabled>Silahkan pilih kategori</option>
                                </select>
                                @error('kotak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Berat
                                    <small>
                                        <i class="text-info">Satuan : gram(g)</i>
                                    </small>
                                </label>
                                <input type="number" class="form-control" name="berat" id="berat" placeholder="20.5"
                                    value="{{ old('berat') }}" required>
                                @error('berat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info btn-block" type="submit">Tambah</button>
                        </form>
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        function initializeSelect2(tags, selector, placeholder, apiUrl) {
            let select = $(selector);

            select.select2({
                tags: true,
                placeholder: placeholder,
                theme: 'bootstrap4',
                ajax: {
                    delay: 300,
                    url: function(params) {
                        let search = params.term != null ? params.term : '';
                        console.log(apiUrl + $('#kategori').val() + `/${search}`)
                        return apiUrl + $('#kategori').val() + `/${search}`;
                    },
                    dataType: 'json',
                    processResults: function(res) {
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

            select.empty().trigger('change');
            select.data('select2').options.get('ajax').cache = null;

            $('#kategori').on('change', function() {
                select.empty().trigger('change');
                select.data('select2').options.get('ajax').cache = null;
            });
        }

        initializeSelect2(true, '#model', 'Silahkan pilih model', "{{ url('/api/model/') }}/");
        initializeSelect2(false, '#kotak', 'Silahkan pilih kotak', "{{ url('/api/kotak/') }}/");
    </script>
@endpush
