<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;

class KeranjangController extends Controller
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
    public function store(StoreKeranjangRequest $request)
    {
        $validated = $request->validated();
        list($kodeTipe, $produkId) = explode('-', $validated['kodeBarcode']);

        $searchProduk = Produk::with('tipe', 'karat.harga_ref')
            ->where('id', 'LIKE', "$produkId%")
            ->whereHas('tipe', fn ($query) => $query->where('kode_tipe', $kodeTipe))
            ->first();

        if ($searchProduk) {
            if ($searchProduk->status_id == 1) {
                $searchProduk->update([
                    'status_id' => 2,
                    'harga_rugi' => rupiahToInt($validated['hargaRugi'])
                ]);

                Keranjang::firstOrCreate(
                    [
                        'produk_id' => $searchProduk->id,
                    ],
                    [
                        'harga' => rupiahToInt($validated['harga']),
                        'jenis_transaksi_id' => $validated['jenisTransaksi'],
                        'user_id' => Auth::user()->id
                    ]
                );

                Alert::success('Sukses', 'Produk berhasil dimasukan kedalam keranjang')->persistent(true);
            } else {
                Alert::warning('Gagal', $searchProduk->status_id == 2 ? 'Produk sudah ada dikeranjang' : 'Produk tidak ditemukan')->persistent(true);
            }
        } else {
            Alert::warning('Gagal', 'Produk tidak ditemukan')->persistent(true);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeranjangRequest $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        $keranjang->produk->update(['status_id' => 1]);
        $keranjang->delete();
        Alert::success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
