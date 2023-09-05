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
     * Display a listing of items available for sale.
     */
    public function jual()
    {
        $data['seller'] = User::where('role_id', 3)->get();
        $data['keranjang'] = Keranjang::with('produk', 'produk.karat', 'produk.tipe')
            ->where('user_id', Auth::user()->id)
            ->where('jenis_transaksi_id', 1)
            ->get();
        return view('kasir.jual.index', compact('data'));
    }

    /**
     * Display the sales history for today.
     */
    public function jualHistori()
    {
        $today = Carbon::now()->toDateString();
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->where('jenis_transaksi_id', 1)
            ->whereDate('created_at', $today)
            ->get();
        return view('kasir.jual.histori', compact('data'));
    }

    /**
     * Display a listing of items available for purchase.
     */
    public function beli($kodeTransaksi = null)
    {
        $data['kodeTransaksi'] = $kodeTransaksi;
        $data['detailTransaksi'] = TransaksiDetail::with('produk')
            ->where('kode_transaksi', $kodeTransaksi)
            ->get();
        $data['seller'] = User::where('role_id', 3)->get();
        $data['keranjang'] = Keranjang::with('produk', 'produk.karat', 'produk.tipe')
            ->where('user_id', Auth::user()->id)
            ->where('jenis_transaksi_id', 2)
            ->get();


        if ($data['detailTransaksi']->isEmpty() && !empty($kodeTransaksi)) {
            Alert::warning('warning', 'Transaksi tidak ditemukan.');
            return redirect()->back();
        }
        return view('kasir.beli.index', compact('data'));
    }

    /**
     * Display the purchase history for today.
     */
    public function beliHistori()
    {
        $today = Carbon::now()->toDateString();
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->where('jenis_transaksi_id', 2)
            ->whereDate('created_at', $today)
            ->get();
        return view('kasir.beli.histori', compact('data'));
    }

    /**
     * Display the view for exchange and addition transactions.
     */
    public function tukarTambah()
    {
        //
    }

    /**
     * Store a newly created sales transaction in storage.
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
        Keranjang::where('user_id', Auth::user()->id)->where('jenis_transaksi_id', 1)->delete();
        Alert::success('Success', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Store a newly created sales transaction in storage.
     */
    public function storeBeli(StoreTransaksiRequest $request)
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
            'jenis_transaksi_id' => 2,
        ]);

        $keranjang = Keranjang::where('user_id', Auth::user()->id);

        $transaksiDetails = [];

        foreach ($keranjang->get() as $item) {

            $copiedProduct = new Produk($item->produk->toArray());
            $copiedProduct->status_id = 5;
            $copiedProduct->harga_rugi = null;
            $copiedProduct->save();

            $item->produk->status_id = 4;
            $item->produk->save();

            $transaksiDetails[] = [
                'kode_transaksi' => $transaksi->kode_transaksi,
                'harga' => $item->harga,
                'produk_id' => $item->produk_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        TransaksiDetail::insert($transaksiDetails);
        Keranjang::where('user_id', Auth::user()->id)->where('jenis_transaksi_id', 2)->delete();
        Alert::success('Success', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Display the details of a specific sales transaction.
     */
    public function showDetailHistori(Transaksi $transaksi)
    {
        $data['transaksi'] = $transaksi->load('transaksiDetail', 'member', 'user');
        return view('kasir.jual.historiDetail', compact('data'));
    }
}
