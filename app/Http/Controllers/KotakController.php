<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Kotak;
use App\Models\Kategori;
use App\Http\Requests\StoreKotakRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateKotakRequest;

class KotakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kotak'] = Kategori::withCount('kotak')->get();
        $data['blok'] = Blok::all();
        $data['kategori'] = Kategori::all();
        return view('master-data.barang.kotak', compact('data'));
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
    public function show(Kotak $kotak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kotak $kotak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKotakRequest $request, Kotak $kotak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kotak $kotak)
    {
        //
    }
}
