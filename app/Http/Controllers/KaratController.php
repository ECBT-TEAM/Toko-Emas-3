<?php

namespace App\Http\Controllers;

use App\Models\Karat;
use App\Http\Requests\StoreKaratRequest;
use App\Http\Requests\UpdateKaratRequest;
use RealRashid\SweetAlert\Facades\Alert;

class KaratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['karat'] = Karat::with('harga_ref')->get();
        return view('master-data.barang.karat', compact('data'));
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
    public function store(StoreKaratRequest $request)
    {
        $validated = $request->validated();
        Karat::create($validated);
        Alert::success('Sukses', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Karat $karat)
    {
        $data['karat'] = $karat->harga_ref()->orderBy('harga', 'asc')->get();
        return view('master-data.barang.karat-detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karat $karat)
    {
        $data['karat'] = $karat;
        return view('master-data.barang.karat-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaratRequest $request, Karat $karat)
    {
        $validated = $request->validated();
        $karat->update($validated);
        Alert::success('Sukses', 'Data berhasil diubah.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karat $karat)
    {
        $karat->delete();
        Alert::success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
