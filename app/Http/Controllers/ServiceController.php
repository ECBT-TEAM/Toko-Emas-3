<?php

namespace App\Http\Controllers;

use App\Models\Service;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Produk;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($statusSlug)
    {
        $statusSlug = $statusSlug == 'cuci' ? null : $statusSlug;

        $data['servis'] = Service::with(['produk', 'kondisi'])
            ->groupBy('produk_id')
            ->select('produk_id')
            ->whereHas('produk', function ($query) use ($statusSlug) {
                $kondisi = ucwords(str_replace('-', ' ', $statusSlug));
                $query->where('kondisi', $kondisi);
            })
            ->get();

        return view('servis.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function selesai()
    {
        $data['servis'] = Service::with(['produk', 'kondisi'])
            ->groupBy('produk_id')
            ->select('produk_id')
            ->whereHas('produk', function ($query) {
                $query->where('kondisi', null)->where('kotak_id', null);
            })
            ->get();

        return view('servis.selesai', compact('data'));
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

        Service::where('produk_id', $produkId)->delete();

        foreach ($validated['kondisi'] as $kondisi) {
            Service::create([
                'produk_id' => $produkId,
                'kondisi_id' => $kondisi,
                'harga' => rupiahToInt($validated['hargaRusak'])
            ]);
        }

        Produk::where('id', $produkId)->update([
            'kondisi' => $validated['status']
        ]);

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
    public function update(Produk $produk)
    {
        $produk->kondisi = null;
        $produk->status_id = 3;
        $produk->save();
        Alert::success('success', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function selesaiServis(UpdateServiceRequest $request, Produk $produk)
    {
        $validated = $request->validated();
        $produk->kotak_id = $validated['kotak'];
        $produk->save();
        Alert::success('success', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
