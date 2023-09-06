<?php

namespace App\Http\Controllers;

use App\Models\Service;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
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
    public function store(StoreServiceRequest $request, $produkId)
    {
        $validated = $request->validated();

        foreach ($validated['kondisi'] as $kondisi) {
            Service::firstOrcreate([
                'produk_id' => $produkId,
                'kondisi_id' => $kondisi,
            ], [
                'harga' => rupiahToInt($validated['harga'])
            ]);
        }

        Alert::success('success', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
