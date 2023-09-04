<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function jual()
    {
        $data['seller'] = User::where('role_id', 3)->get();
        $data['keranjang'] = Keranjang::with('produk', 'produk.karat', 'produk.tipe')->where('user_id', Auth::user()->id)->where('jenis_transaksi_id', 1)->get();
        return view('kasir.jual.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function jualHistori()
    {
        $today = Carbon::now()->toDateString();
        $data['transaksi'] = Transaksi::with('member', 'user')->where('cabang_id', Auth::user()->cabang_id)->where('jenis_transaksi_id', 1)->whereDate('created_at', $today)->get();
        return view('kasir.jual.histori', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function showDetailHistori(Transaksi $transaksi)
    {
        $data['transaksi'] = $transaksi->load('transaksiDetail', 'member', 'user');
        return view('kasir.jual.historiDetail', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function balen()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function tukarTambah()
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
    public function storeJual(StoreTransaksiRequest $request)
    {
        $validated = $request->validated();

        $member = Member::firstOrCreate(
            ['hp' => $validated['hp'], 'nama' => $validated['nama']],
            ['alamat' => $validated['alamat']]
        );

        $transaksi = Transaksi::create([
            'metode_pembayaran' => $validated['metodeBayar'],
            'norek' => $validated['norek'],
            'member_id' => $member->id,
            'kasir_id' => $validated['seller'],
            'cabang_id' => Auth::user()->cabang_id,
            'jenis_transaksi_id' => 1,
        ]);

        $keranjang = Keranjang::where('user_id', Auth::user()->id);

        $transaksiDetails = [];

        foreach ($keranjang->get() as $item) {
            $transaksiDetails[] = [
                'kode_transaksi' => $transaksi->kode_transaksi,
                'harga' => $item->harga,
                'produk_id' => $item->produk_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Produk::where('id', $item->produk_id)->update(['status_id' => 3]);
        }


        TransaksiDetail::insert($transaksiDetails);
        Keranjang::where('user_id', Auth::user()->id)->delete();
        Alert::success('Sukses', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
