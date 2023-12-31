<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategori'] = Kategori::all();
        return view('master-data.barang.kategori.index', compact('data'));
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
    public function store(StoreKategoriRequest $request)
    {
        $validated = $request->validated();
        Kategori::create($validated);
        Alert::success('Sukses', 'Berhasil membuat kategori barang.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data['kategori'] = $kategori;
        return view('master-data.barang.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $validated = $request->validated();

        $kategori->update($validated);

        Alert::success('Sukses', 'Berhasil mengedit kategori barang.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            Alert::success('Sukses', 'Berhasil menghapus kategori barang.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Terdapat kotak pada kategori barang tersebut.');
            return redirect()->back();
        }
    }
}
