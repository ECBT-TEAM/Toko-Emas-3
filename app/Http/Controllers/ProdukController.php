<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Tipe;
use App\Models\Karat;
use App\Models\Kotak;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authCabangId = Auth::user()->cabang_id;
        $data['kotak'] = Kategori::withCount(['kotak' => function ($query) use ($authCabangId) {
            $query->whereHas('blok', function ($query) use ($authCabangId) {
                $query->where('cabang_id', $authCabangId);
            });
        }])->get();
        $data['blok'] = Blok::where('cabang_id', Auth::user()->cabang_id)->get();
        $data['kategori'] = Kategori::all();
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kategori'] = Kategori::all();
        $data['karat'] = Karat::all();
        $data['supplier'] = Supplier::all();
        return view('produk.tambah', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        $validated = $request->validated();


        $tipe = Tipe::firstOrCreate([
            'id' => $validated['model'],
        ], [
            'kode_tipe' => generateKodeProduk($validated['kategori']),
            'nama' => $validated['model'],
            'kategori_id' => $validated['kategori'],
        ]);

        Produk::create([
            'berat' => $validated['berat'],
            'tipe_id' => $tipe->id,
            'karat_id' => $validated['karat'],
            'supplier_id' => $validated['sumber'],
            'kotak_id' => $validated['kotak'],
        ]);

        Alert::success('Sukses', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($kategoriId)
    {
        $data['kotak'] = Kotak::with('blok')
            ->whereHas('blok', function ($query) {
                $query->where('cabang_id', Auth::user()->cabang_id);
            })
            ->whereHas('produk', function ($query) {
                $query->where('status_id', 1);
            })
            ->where('kategori_id', $kategoriId)
            ->withCount([
                'produk as produk_count' => function ($query) {
                    $query->where('status_id', 1);
                }
            ])->get();
        $data['kategoriId'] = $kategoriId;
        return view('produk.detail', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function showProuk($kategoriId, $kotakId)
    {
        $commonConditions = function ($query) use ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        };

        $data['produk'] = Produk::with(['kotak', 'tipe', 'karat', 'supplier'])
            ->select('produks.*')
            ->join('tipes', 'produks.tipe_id', '=', 'tipes.id')
            ->where('status_id', 1)
            ->whereHas('tipe', $commonConditions)
            ->whereHas('kotak.blok', function ($query) {
                $query->where('cabang_id', Auth::user()->cabang_id);
            })
            ->where('kotak_id', $kotakId)
            ->orderBy('tipes.nama')
            ->get();

        $data['beratProduk'] = Produk::whereHas('tipe', $commonConditions)
            ->where('status_id', 1)
            ->whereHas('kotak.blok', function ($query) {
                $query->where('cabang_id', Auth::user()->cabang_id);
            })
            ->sum('berat');

        $data['beratKotak'] = Kotak::where('id', $kotakId)->value('berat');
        $data['beratTotal'] = $data['beratProduk'] + $data['beratKotak'];
        $data['kategori'] = $kategoriId;

        return view('produk.detailProduk', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        Alert::success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
