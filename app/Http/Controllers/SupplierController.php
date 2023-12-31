<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Database\QueryException;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['supplier'] = Supplier::all();
        return view('master-data.supplier.index', compact('data'));
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
    public function store(StoreSupplierRequest $request)
    {
        $validated = $request->validated();
        Supplier::create($validated);
        Alert::success('Sukses', 'Berhasil membuat supplier.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $data['supplier'] = $supplier;
        return view('master-data.supplier.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $validated = $request->validated();
        $supplier->update($validated);
        Alert::success('Sukses', 'Berhasil mengedit supplier.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            Alert::success('Sukses', 'Berhasil menghapus supplier.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Supplier sedang digunakan dalam transaksi.');
            return redirect()->back();
        }
    }
}
