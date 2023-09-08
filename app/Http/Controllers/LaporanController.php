<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tipe;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($awal = null, $akhir = null)
    {
        $cabang = Auth::user()->cabang_id;
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', $cabang)
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
        $cabang = Auth::user()->cabang_id;

        $data['piechart'] = $categories->map(function ($category) use ($cabang) {
            $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category) {
                $query->where('id', $category->id);
            })
                ->whereHas('transaksi', function ($query) use ($cabang) {
                    $query->where('jenis_transaksi_id', 1)->where('cabang_id', $cabang);
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
            $day = $sevenDaysAgo->copy()->addDays($i)->format('l');
            $data['barchart']['labels'][] = $day;
        }

        foreach ($categories as $category) {
            $totalPurchasesData = [];
            for ($i = 0; $i < 7; $i++) {
                $day = $sevenDaysAgo->copy()->addDays($i)->format('l'); // Nama hari
                $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category, $cabang) {
                    $query->where('id', $category->id);
                })
                    ->whereHas('transaksi', function ($query) use ($cabang) {
                        $query->where('jenis_transaksi_id', 1)->where('cabang_id', $cabang);
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
        $categories = Kategori::with('tipe')->get();
        $cabang = Auth::user()->cabang_id;

        $today = Carbon::now();
        $oneWeekAgo = $today->copy()->subWeek();

        $data['piechart'] = $categories->map(function ($category) use ($oneWeekAgo, $today, $cabang) {
            $categoryName = $category->nama;
            $tipes = $category->tipe->map(function ($tipe) use ($oneWeekAgo, $today, $cabang) {
                $tipeName = $tipe->nama;

                $totalTransaksi = TransaksiDetail::whereHas('produk', function ($query) use ($tipe) {
                    $query->where('tipe_id', $tipe->id);
                })
                    ->whereHas('transaksi', function ($query) use ($cabang) {
                        $query->where('cabang_id', $cabang);
                    })
                    ->where('jenis_transaksi_id', 1)
                    ->whereDate('created_at', '>=', $oneWeekAgo)
                    ->whereDate('created_at', '<=', $today)
                    ->count();

                return [
                    'nama' => ucwords($tipeName),
                    'total' => $totalTransaksi,
                ];
            })->take(10);

            return [
                'kategori' => $categoryName,
                'tipe' => $tipes->toArray(),
            ];
        })->toArray();

        return view('laporan.jual.model', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexSupplier($supplier = null)
    {
        $categories = Kategori::with('tipe')->get();
        $cabang = Auth::user()->cabang_id;

        $today = Carbon::now();
        $oneWeekAgo = $today->copy()->subWeek();

        $data['piechart'] = $categories->map(function ($category) use ($oneWeekAgo, $today, $supplier, $cabang) {
            $categoryName = $category->nama;
            $tipes = $category->tipe->map(function ($tipe) use ($oneWeekAgo, $today, $supplier, $cabang) {
                $tipeName = $tipe->nama;

                $totalTransaksi = TransaksiDetail::whereHas('produk', function ($query) use ($tipe, $supplier) {
                    $query->where('tipe_id', $tipe->id)->where('supplier_id', $supplier);
                })
                    ->whereHas('transaksi', function ($query) use ($cabang) {
                        $query->where('cabang_id', $cabang);
                    })
                    ->where('jenis_transaksi_id', 1)
                    ->whereDate('created_at', '>=', $oneWeekAgo)
                    ->whereDate('created_at', '<=', $today)
                    ->count();

                return [
                    'nama' => ucwords($tipeName),
                    'total' => $totalTransaksi,
                ];
            })->take(10);

            return [
                'kategori' => $categoryName,
                'tipe' => $tipes->toArray(),
            ];
        })->toArray();

        $data['supplier'] = Supplier::all();

        return view('laporan.jual.supplier', compact('data'));
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
        $cabang =  Auth::user()->cabang_id;
        $data['transaksi'] = Transaksi::with('member', 'user')
            ->where('cabang_id', $cabang)
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
        $cabang =  Auth::user()->cabang_id;

        $data['piechart'] = $categories->map(function ($category) use ($cabang) {
            $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($category, $cabang) {
                $query->where('id', $category->id);
            })
                ->whereHas('transaksi', function ($query) use ($cabang) {
                    $query->where('jenis_transaksi_id', 1)->where('cabang_id', $cabang);
                })
                ->where('jenis_transaksi_id', 2)
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
                $totalPurchases = TransaksiDetail::whereHas('produk.tipe.kategori', function ($query) use ($cabang) {
                    $query->where('jenis_transaksi_id', 1)->where('cabang_id', $cabang);
                })
                    ->where('jenis_transaksi_id', 2)
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
        $categories = Kategori::with('tipe')->get();
        $cabang = Auth::user()->cabang_id;

        $today = Carbon::now();
        $oneWeekAgo = $today->copy()->subWeek();

        $data['piechart'] = $categories->map(function ($category) use ($oneWeekAgo, $today, $cabang) {
            $categoryName = $category->nama;
            $tipes = $category->tipe->map(function ($tipe) use ($oneWeekAgo, $today, $cabang) {
                $tipeName = $tipe->nama;

                $totalTransaksi = TransaksiDetail::whereHas('produk', function ($query) use ($tipe) {
                    $query->where('tipe_id', $tipe->id);
                })
                    ->whereHas('transaksi', function ($query) use ($cabang) {
                        $query->where('cabang_id', $cabang);
                    })
                    ->where('jenis_transaksi_id', 2)
                    ->whereDate('created_at', '>=', $oneWeekAgo)
                    ->whereDate('created_at', '<=', $today)
                    ->count();

                return [
                    'nama' => ucwords($tipeName),
                    'total' => $totalTransaksi,
                ];
            })->take(10);

            return [
                'kategori' => $categoryName,
                'tipe' => $tipes->toArray(),
            ];
        })->toArray();

        return view('laporan.beli.model', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexSupplierBeli($supplier = null)
    {
        $categories = Kategori::with('tipe')->get();
        $cabang = Auth::user()->cabang_id;

        $today = Carbon::now();
        $oneWeekAgo = $today->copy()->subWeek();

        $data['piechart'] = $categories->map(function ($category) use ($oneWeekAgo, $today, $supplier, $cabang) {
            $categoryName = $category->nama;
            $tipes = $category->tipe->map(function ($tipe) use ($oneWeekAgo, $today, $supplier, $cabang) {
                $tipeName = $tipe->nama;

                $totalTransaksi = TransaksiDetail::whereHas('produk', function ($query) use ($tipe, $supplier) {
                    $query->where('tipe_id', $tipe->id)->where('supplier_id', $supplier);
                })
                    ->whereHas('transaksi', function ($query) use ($cabang) {
                        $query->where('cabang_id', $cabang);
                    })
                    ->where('jenis_transaksi_id', 2)
                    ->whereDate('created_at', '>=', $oneWeekAgo)
                    ->whereDate('created_at', '<=', $today)
                    ->count();

                return [
                    'nama' => ucwords($tipeName),
                    'total' => $totalTransaksi,
                ];
            })->take(10);

            return [
                'kategori' => $categoryName,
                'tipe' => $tipes->toArray(),
            ];
        })->toArray();

        $data['supplier'] = Supplier::all();

        return view('laporan.beli.supplier', compact('data'));
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
