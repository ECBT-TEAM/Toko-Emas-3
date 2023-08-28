<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Kotak;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreKotakRequest;
use App\Http\Requests\UpdateKotakRequest;

class KotakController extends Controller
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
        return view('master-data.barang.kotak.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKotakRequest $request)
    {
        $validated = $request->validated();

        $lastKotak = Kotak::where('jenis', $validated['jenis'])
            ->where('blok_id', $validated['blok'])
            ->max('nomor');
        $lastKotak = $lastKotak !== null ? $lastKotak + 1 : 1;

        Kotak::firstOrCreate([
            'nomor' => $lastKotak,
            'jenis' => $validated['jenis'],
            'berat' => $validated['berat'],
            'blok_id' => $validated['blok'],
            'kategori_id' => $validated['kategori'],
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
            ->withCount('produk')
            ->whereHas('blok', function ($query) {
                $query->where('cabang_id', Auth::user()->cabang_id);
            })
            ->where('kategori_id', $kategoriId)
            ->get();
        $data['kategoriId'] = $kategoriId;
        return view('master-data.barang.kotak.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kategoriId, Kotak $kotak)
    {
        $data['kotak'] = $kotak;
        $data['blok'] = Blok::where('cabang_id', Auth::user()->cabang_id)->get();
        $data['kategori'] = Kategori::all();
        $data['kategoriId'] = $kategoriId;
        return view('master-data.barang.kotak.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKotakRequest $request, Kotak $kotak)
    {
        $validated = $request->validated();
        $kotak->update([
            'nomor' => $validated['nomor'],
            'jenis' => $validated['jenis'],
            'berat' => $validated['berat'],
            'blok_id' => $validated['blok'],
            'kategori_id' => $validated['kategori'],
        ]);
        Alert::success('Sukses', 'Data berhasil diubah.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kotak $kotak)
    {
        $kotak->delete();
        Alert::success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
