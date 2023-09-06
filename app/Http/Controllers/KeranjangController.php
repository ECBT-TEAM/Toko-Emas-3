<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;
use App\Models\TransaksiDetail;

class KeranjangController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function storeJual(StoreKeranjangRequest $request)
    {
        $validated = $request->validated();
        list($kodeTipe, $produkId) = explode('-', $validated['kodeBarcode']);

        $searchProduk = Produk::with('tipe', 'karat.harga_ref')
            ->where('id', 'LIKE', "$produkId%")
            ->whereHas('tipe', fn ($query) => $query->where('kode_tipe', $kodeTipe))
            ->where('status_id', 1)
            ->first();

        if ($searchProduk) {
            $hargaRugi = rupiahToInt($validated['hargaRugi']);
            $harga = rupiahToInt($validated['harga']);

            $keranjang = Keranjang::firstOrCreate(
                ['produk_id' => $searchProduk->id],
                [
                    'harga' => $harga,
                    'jenis_transaksi_id' => 1,
                    'user_id' => Auth::user()->id
                ]
            );

            if ($keranjang->wasRecentlyCreated) {
                $searchProduk->update([
                    'status_id' => 2,
                    'harga_rugi' => $hargaRugi
                ]);

                Alert::success('Sukses', 'Produk berhasil dimasukan kedalam keranjang')->persistent(true);
            } else {
                Alert::warning('Gagal', 'Produk sudah ada dikeranjang')->persistent(true);
            }
        } else {
            Alert::warning('Gagal', 'Produk tidak ditemukan')->persistent(true);
        }

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function storeBeli($kodeTransaksi, $kodeProduk)
    {
        $transaksiDetail = TransaksiDetail::where('kode_transaksi', $kodeTransaksi)
            ->where('produk_id', $kodeProduk)
            ->with('produk.status')
            ->first();

        if (!$transaksiDetail || $transaksiDetail->produk->status_id != 3) {
            $produkStatus = $transaksiDetail ? 'Status produk : ' . $transaksiDetail->produk->status->nama : 'Produk tidak ditemukan';
            Alert::warning('Gagal', $produkStatus)->persistent(true);
            return redirect()->back();
        }

        $harga = $transaksiDetail->harga - ($transaksiDetail->produk->harga_rugi * $transaksiDetail->produk->berat);

        $keranjang = Keranjang::firstOrCreate(
            [
                'produk_id' => $transaksiDetail->produk->id,
            ],
            [
                'harga' => $harga,
                'jenis_transaksi_id' => 2,
                'user_id' => Auth::user()->id
            ]
        );

        if ($keranjang->wasRecentlyCreated) {
            $transaksiDetail->produk->update([
                'status_id' => 2,
            ]);

            Alert::success('Sukses', 'Produk berhasil dimasukan kedalam keranjang')->persistent(true);
        } else {
            Alert::warning('Gagal', 'Produk sudah ada dikeranjang')->persistent(true);
        }

        return redirect()->back();
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
        $status = [
            '1' => 1,
            '2' => 3,
        ][$keranjang->jenis_transaksi_id] ?? null;

        if ($status !== null) {
            $keranjang->produk->update(['status_id' => $status]);
            $keranjang->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } else {
            Alert::warning('Gagal', 'Status tidak sesuai')->persistent(true);
        }
        return redirect()->back();
    }
}
