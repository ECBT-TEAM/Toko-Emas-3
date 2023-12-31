<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Member;
use App\Models\Produk;
use App\Models\Kondisi;
use App\Models\Service;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\StoreTransaksiRequestBeli;
use App\Http\Requests\StoreTransaksiRequestTukarTambah;
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
            ->orderBY('created_at', 'desc')
            ->get();
        return view('kasir.jual.histori', compact('data'));
    }

    /**
     * Display a listing of items available for purchase.
     */
    public function beli($kodeTransaksi = null)
    {
        $data['kondisi'] = Kondisi::all();
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
     * Display a listing of items available for purchase.
     */
    public function beliManual($kodeTransaksi = null)
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
        return view('kasir.beli.manual', compact('data'));
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
            ->orderBY('created_at', 'desc')
            ->get();
        return view('kasir.beli.histori', compact('data'));
    }

    /**
     * Display the view for exchange and addition transactions.
     */
    public function tukarTambah($kodeTransaksi = null)
    {
        $data['kondisi'] = Kondisi::all();
        $data['kodeTransaksi'] = $kodeTransaksi;
        $data['detailTransaksi'] = TransaksiDetail::with('produk')
            ->where('kode_transaksi', $kodeTransaksi)
            ->get();
        $data['seller'] = User::where('role_id', 3)->get();
        $data['keranjangMasuk'] = Keranjang::with('produk', 'produk.karat', 'produk.tipe')
            ->where('user_id', Auth::user()->id)
            ->where('jenis_transaksi_id', 3)
            ->where('status', 1)
            ->get();
        $data['keranjangKeluar'] = Keranjang::with('produk', 'produk.karat', 'produk.tipe')
            ->where('user_id', Auth::user()->id)
            ->where('jenis_transaksi_id', 3)
            ->where('status', 2)
            ->get();


        if ($data['detailTransaksi']->isEmpty() && !empty($kodeTransaksi)) {
            Alert::warning('warning', 'Transaksi tidak ditemukan.');
            return redirect()->back();
        }
        return view('kasir.tukarTambah.index', compact('data'));
    }

    /**
     * Display the purchase history for today.
     */
    public function tukarTambahHistori()
    {
        $today = Carbon::now()->toDateString();
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->where('jenis_transaksi_id', 3)
            ->whereDate('created_at', $today)
            ->orderBY('created_at', 'desc')
            ->get();
        return view('kasir.tukarTambah.histori', compact('data'));
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
                'jenis_transaksi_id' => 1,
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
    public function storeBeli(StoreTransaksiRequestBeli $request, $kodeTransaksi)
    {
        try {
            $validated = $request->validated();
            $user_id = Auth::user()->id;
            $keranjang = Keranjang::where('user_id', $user_id)->where('jenis_transaksi_id', 2)->get();

            if ($keranjang->isEmpty()) {
                Alert::warning('Warning', 'Keranjang belanja kosong. Silakan tambahkan produk ke dalam keranjang.');
                return redirect()->back();
            }

            $member = Transaksi::where('kode_transaksi', $kodeTransaksi)->first()->member_id;

            DB::beginTransaction();

            $transaksi = Transaksi::create([
                'metode_pembayaran' => $validated['metodeBayar'],
                'norek' => $validated['norek'],
                'member_id' => $member,
                'kasir_id' => $validated['seller'],
                'cabang_id' => Auth::user()->cabang_id,
                'jenis_transaksi_id' => 2,
            ]);

            $transaksiDetails = [];

            foreach ($keranjang as $item) {
                $copiedProduct = new Produk($item->produk->toArray());
                $copiedProduct->id = Uuid::uuid4()->toString();
                $copiedProduct->status_id = 5;
                $copiedProduct->kotak_id = null;
                $copiedProduct->harga_rugi = null;
                $copiedProduct->save();

                $item->produk->status_id = 4;
                $item->produk->save();

                $transaksiDetails[] = [
                    'kode_transaksi' => $transaksi->kode_transaksi,
                    'harga' => $item->harga,
                    'produk_id' => $copiedProduct->id,
                    'jenis_transaksi_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                Service::where('produk_id', $item->produk_id)->update(['produk_id' => $copiedProduct->id]);
                Service::where('produk_id', $item->produk_id)->update(['produk_id' => $copiedProduct->id]);
            }

            $produkIds = $keranjang->pluck('produk_id')->toArray();
            $sisaProduk = TransaksiDetail::whereNotIn('produk_id', $produkIds)
                ->where('kode_transaksi', $kodeTransaksi)
                ->get()
                ->pluck('produk_id')
                ->toArray();

            $oldProduk = Produk::whereIn('id', $sisaProduk)->where('status_id', 3)->get();

            if (!$oldProduk->isEmpty()) {
                foreach ($oldProduk as $produk) {
                    $copiedProduct = new Produk($produk->toArray());
                    $copiedProduct->id = Uuid::uuid4()->toString();
                    $copiedProduct->save();

                    $copiedProductId = $copiedProduct->id;

                    $produk->status_id = 6;
                    $produk->save();

                    $oldTransaksi = TransaksiDetail::where('produk_id', $produk->id)
                        ->where('kode_transaksi', $kodeTransaksi)
                        ->first();
                    $newTransaksi = $oldTransaksi->replicate();
                    $newTransaksi->produk_id = $copiedProductId;
                    $newTransaksi->kode_transaksi = $transaksi->kode_transaksi;
                    $newTransaksi->jenis_transaksi_id = 4;
                    $newTransaksi->save();
                }
            }

            TransaksiDetail::insert($transaksiDetails);
            Keranjang::where('user_id', $user_id)->where('jenis_transaksi_id', 2)->delete();
            DB::commit();

            Alert::success('Success', 'Data berhasil disimpan.');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());

            Alert::warning('Warning', 'Gagal menyimpan database.\n' . $e);
            return redirect()->back();
        }
    }

    /**
     * Store a newly created sales transaction in storage.
     */
    public function storeTukarTambah(StoreTransaksiRequestTukarTambah $request, $kodeTransaksi)
    {
        try {
            $validated = $request->validated();
            $user_id = Auth::user()->id;
            $keranjang = Keranjang::where('user_id', $user_id)->where('jenis_transaksi_id', 3)->whereIn('status', [1, 2])->get();

            if ($keranjang->isEmpty()) {
                Alert::warning('Warning', 'Keranjang belanja kosong. Silakan tambahkan produk ke dalam keranjang.');
                return redirect()->back();
            }

            $member = Transaksi::where('kode_transaksi', $kodeTransaksi)->first()->member_id;

            DB::beginTransaction();

            $transaksi = Transaksi::create([
                'metode_pembayaran' => $validated['metodeBayar'],
                'norek' => $validated['norek'],
                'member_id' => $member,
                'kasir_id' => $validated['seller'],
                'cabang_id' => Auth::user()->cabang_id,
                'jenis_transaksi_id' => 3,
            ]);

            $transaksiDetails = [];

            foreach ($keranjang as $item) {
                if ($item->status == 1) {
                    $copiedProduct = new Produk($item->produk->toArray());
                    $copiedProduct->id = Uuid::uuid4()->toString();
                    $copiedProduct->status_id = 5;
                    $copiedProduct->kotak_id = null;
                    $copiedProduct->save();

                    $item->produk->status_id = 4;
                    $item->produk->save();

                    $transaksiDetails[] = [
                        'kode_transaksi' => $transaksi->kode_transaksi,
                        'harga' => $item->harga,
                        'produk_id' => $copiedProduct->id,
                        'jenis_transaksi_id' => 3,
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    Service::where('produk_id', $item->produk_id)->update(['produk_id' => $copiedProduct->id]);
                    Service::where('produk_id', $item->produk_id)->update(['produk_id' => $copiedProduct->id]);
                } else {
                    $transaksiDetails[] = [
                        'kode_transaksi' => $transaksi->kode_transaksi,
                        'harga' => $item->harga,
                        'produk_id' => $item->produk_id,
                        'jenis_transaksi_id' => 3,
                        'status' => 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    Produk::where('id', $item->produk_id)->update(['status_id' => 3]);
                }
            }

            $produkIds = $keranjang->pluck('produk_id')->toArray();
            $sisaProduk = TransaksiDetail::whereNotIn('produk_id', $produkIds)
                ->where('kode_transaksi', $kodeTransaksi)
                ->get()
                ->pluck('produk_id')
                ->toArray();

            $oldProduk = Produk::whereIn('id', $sisaProduk)->where('status_id', 3)->get();

            if (!$oldProduk->isEmpty()) {
                foreach ($oldProduk as $produk) {
                    $copiedProduct = new Produk($produk->toArray());
                    $copiedProduct->id = Uuid::uuid4()->toString();
                    $copiedProduct->save();

                    $copiedProductId = $copiedProduct->id;

                    $produk->status_id = 6;
                    $produk->save();

                    $oldTransaksi = TransaksiDetail::where('produk_id', $produk->id)
                        ->where('kode_transaksi', $kodeTransaksi)
                        ->first();
                    $newTransaksi = $oldTransaksi->replicate();
                    $newTransaksi->produk_id = $copiedProductId;
                    $newTransaksi->kode_transaksi = $transaksi->kode_transaksi;
                    $newTransaksi->jenis_transaksi_id = 4;
                    $newTransaksi->save();
                }
            }

            TransaksiDetail::insert($transaksiDetails);
            Keranjang::where('user_id', $user_id)->where('jenis_transaksi_id', 3)->delete();
            DB::commit();

            Alert::success('Success', 'Data berhasil disimpan.');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());

            Alert::warning('Warning', 'Gagal menyimpan database.\n' . $e);
            return redirect()->back();
        }
    }
}
