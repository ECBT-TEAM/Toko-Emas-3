<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreCabangRequest;
use App\Http\Requests\UpdateCabangRequest;
use Illuminate\Database\QueryException;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cabang'] = Cabang::all();
        return view('master-data.cabang.index', compact('data'));
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
    public function store(StoreCabangRequest $request)
    {
        $validated = $request->validated();
        Cabang::create($validated);
        Alert::success('Sukses', 'Berhasil membuat cabang.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        $data['cabang'] = $cabang;
        return view('master-data.cabang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCabangRequest $request, Cabang $cabang)
    {
        $validated = $request->validated();

        $cabang->update($validated);

        Alert::success('Sukses', 'Berhasil mengedit cabang.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        try {
            $cabang->delete();
            Alert::success('Sukses', 'Berhasil menghapus cabang.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Gagal menghapus cabang.');
            return redirect()->back();
        }
    }
}
