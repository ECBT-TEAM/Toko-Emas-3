<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlokRequest;
use App\Http\Requests\UpdateBlokRequest;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class BlokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['blok'] = Blok::where('cabang_id', Auth::user()->cabang_id)->withCount('kotak')->get();
        return view('master-data.barang.blok.index', compact('data'));
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
    public function store()
    {
        $lastBlok = Blok::where('cabang_id', Auth::user()->cabang_id)
            ->max('nomor');
        $lastBlok = $lastBlok !== null ? $lastBlok + 1 : 1;

        Blok::firstOrCreate([
            'nomor' => $lastBlok,
            'cabang_id' => Auth::user()->cabang_id,
        ]);

        Alert::success('Sukses', 'Berhasil membuat blok.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Blok $blok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blok $blok)
    {
        $authCabangId = Auth::user()->cabang_id;

        if ($blok->cabang_id != $authCabangId) {
            abort(404);
        }

        $data['blok'] = $blok;
        return view('master-data.barang.blok.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlokRequest $request, Blok $blok)
    {

        $authCabangId = Auth::user()->cabang_id;

        if ($blok->cabang_id != $authCabangId) {
            abort(404);
        }

        $validated = $request->validated();
        $blok->update($validated);
        Alert::success('Sukses', 'Berhasil mengedit blok.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blok $blok)
    {

        $authCabangId = Auth::user()->cabang_id;

        if ($blok->cabang_id != $authCabangId) {
            abort(404);
        }

        try {
            $blok->delete();
            Alert::success('Sukses', 'Berhasil menghapus blok.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Terdapat kotak pada blok ini.');
            return redirect()->back();
        }
    }
}
