<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use App\Models\Karat;
use Ramsey\Uuid\Uuid;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
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
        $data['kategori'] = Kategori::all();
        $data['karat'] = Karat::all();
        $data['supplier'] = Supplier::all();
        return view('produk.tambah', compact('data'));
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
    public function store(StoreProdukRequest $request)
    {
        $validated = $request->validated();


        $tipe = Tipe::firstOrCreate([
            'id' => $validated['model'],
        ], [
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
    public function show(Produk $produk)
    {
        //
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
        //
    }
}
