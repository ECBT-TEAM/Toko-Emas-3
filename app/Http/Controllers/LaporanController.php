<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($awal = null, $akhir = null)
    {
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->where('jenis_transaksi_id', 1)
            ->when(!empty($awal) && !empty($akhir), function ($query) use ($awal, $akhir) {
                $awal = date('Y-m-d H:i:s', $awal);
                $akhir = date('Y-m-d H:i:s', $akhir);
                return $query->whereBetween('created_at', [$awal, $akhir]);
            })
            ->when(empty($awal) || empty($akhir), function ($query) {
                return $query->whereDate('created_at', now()->toDateString());
            })
            ->get();

        return view('laporan.jual.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexKategori()
    {
        $categories = Kategori::all();

        $data['piechart'] = $categories->map(function ($category) {
            $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category) {
                $query->where('id', $category->id);
            })
                ->whereHas('transaksi', function ($query) use ($category) {
                    $query->where('jenis_transaksi_id', 1);
                })
                ->count();

            return [
                'kategori' => $category->nama,
                'total' => $totalPurchases,
            ];
        })->toArray();

        $sevenDaysAgo = Carbon::now()->subDays(6);
        $data['barchart'] = [
            'labels' => [],
            'datasets' => [],
        ];

        for ($i = 0; $i < 7; $i++) {
            $day = $sevenDaysAgo->copy()->addDays($i)->format('l'); // Nama hari
            $data['barchart']['labels'][] = $day;
        }

        foreach ($categories as $category) {
            $totalPurchasesData = [];
            for ($i = 0; $i < 7; $i++) {
                $day = $sevenDaysAgo->copy()->addDays($i)->format('l'); // Nama hari
                $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category) {
                    $query->where('id', $category->id);
                })
                    ->whereHas('transaksi', function ($query) use ($category) {
                        $query->where('jenis_transaksi_id', 1);
                    })
                    ->whereDate('created_at', $sevenDaysAgo->copy()->addDays($i)->format('Y-m-d'))
                    ->count();

                $totalPurchasesData[] = $totalPurchases;
            }

            $data['barchart']['datasets'][] = [
                'label' => $category->nama,
                'data' => $totalPurchasesData,
            ];
        }
        return view('laporan.jual.kategori', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexModel()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexSupplier()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexKonsumen()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexBeli($awal = null, $akhir = null)
    {
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->where('jenis_transaksi_id', 2)
            ->when(!empty($awal) && !empty($akhir), function ($query) use ($awal, $akhir) {
                $awal = date('Y-m-d H:i:s', $awal);
                $akhir = date('Y-m-d H:i:s', $akhir);
                return $query->whereBetween('created_at', [$awal, $akhir]);
            })
            ->when(empty($awal) || empty($akhir), function ($query) {
                return $query->whereDate('created_at', now()->toDateString());
            })
            ->get();

        return view('laporan.beli.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexKategoriBeli()
    {
        $categories = Kategori::all();

        $data['piechart'] = $categories->map(function ($category) {
            $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category) {
                $query->where('id', $category->id);
            })
                ->whereHas('transaksi', function ($query) use ($category) {
                    $query->where('jenis_transaksi_id', 2);
                })
                ->count();

            return [
                'kategori' => $category->nama,
                'total' => $totalPurchases,
            ];
        })->toArray();

        $sevenDaysAgo = Carbon::now()->subDays(6);
        $data['barchart'] = [
            'labels' => [],
            'datasets' => [],
        ];

        for ($i = 0; $i < 7; $i++) {
            $day = $sevenDaysAgo->copy()->addDays($i)->format('l'); // Nama hari
            $data['barchart']['labels'][] = $day;
        }

        foreach ($categories as $category) {
            $totalPurchasesData = [];
            for ($i = 0; $i < 7; $i++) {
                $day = $sevenDaysAgo->copy()->addDays($i)->format('l'); // Nama hari
                $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category) {
                    $query->where('id', $category->id);
                })
                    ->whereHas('transaksi', function ($query) use ($category) {
                        $query->where('jenis_transaksi_id', 2);
                    })
                    ->whereDate('created_at', $sevenDaysAgo->copy()->addDays($i)->format('Y-m-d'))
                    ->count();

                $totalPurchasesData[] = $totalPurchases;
            }

            $data['barchart']['datasets'][] = [
                'label' => $category->nama,
                'data' => $totalPurchasesData,
            ];
        }
        return view('laporan.beli.kategori', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexModelBeli()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexSupplierBeli()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexKonsumenBeli()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $data['transaksi'] = $transaksi->load('transaksiDetail', 'member', 'user');
        return view('laporan.detail', compact('data'));
    }
}
