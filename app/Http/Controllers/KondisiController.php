<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreKondisiRequest;
use App\Http\Requests\UpdateKondisiRequest;
use Illuminate\Database\QueryException;

class KondisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kondisi'] = Kondisi::all();
        return view('master-data.barang.kondisi.index', compact('data'));
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
    public function store(StoreKondisiRequest $request)
    {
        $validated = $request->validated();
        Kondisi::create($validated);
        Alert::success('Sukses', 'Berhasil membuat kondisi barang.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kondisi $kondisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kondisi $kondisi)
    {
        $data['kondisi'] = $kondisi;
        return view('master-data.barang.kondisi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKondisiRequest $request, Kondisi $kondisi)
    {
        $validated = $request->validated();
        $kondisi->update($validated);
        Alert::success('Sukses', 'Berhasil mengedit kondisi barang.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kondisi $kondisi)
    {
        try {
            $kondisi->delete();
            Alert::success('Sukses', 'Berhasil menghapus kondisi barang.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Kondisi barang telah digunakan untuk transaksi.');
            return redirect()->back();
        }
    }
}
