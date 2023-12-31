<?php

namespace App\Http\Controllers;

use App\Models\HargaRef;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Storeharga_refRequest;
use App\Http\Requests\Updateharga_refRequest;
use Illuminate\Database\QueryException;

class HargaRefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Storeharga_refRequest $request)
    {
        $validated = $request->validated();
        HargaRef::create([
            'harga' => rupiahToInt($validated['harga']),
            'karat_id' => $validated['karat'],
        ]);
        Alert::success('Sukses', 'Berhasil membuat ref harga.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(HargaRef $harga_ref)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HargaRef $harga_ref)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateharga_refRequest $request, HargaRef $harga_ref)
    {
        $validated = $request->validated();
        $validated['harga'] = rupiahToInt($validated['harga']);
        $harga_ref->update($validated);
        Alert::success('Sukses', 'Berhasil mengedit ref harga.');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(HargaRef $harga_ref)
    {

        $harga_ref->status = $harga_ref->status == 1 ? 0 : 1;
        $harga_ref->save();
        Alert::success('Sukses', 'Berhasil merubah status ref harga.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HargaRef $harga_ref)
    {
        try {
            $harga_ref->delete();
            Alert::success('Sukses', 'Berhasil menghapus ref harga.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Harga ref sedang digunakan untuk transaksi, non aktif kan status jika ref harga tidak digunakan.');
            return redirect()->back();
        }
    }
}
