<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use App\Models\Kotak;
use App\Models\Member;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function searchModel($kategori = null, $search = null)
    {
        $tipes = Tipe::where('kategori_id', $kategori)
            ->where('nama', 'like', "%$search%")
            ->select('id', 'nama as text')
            ->orderBy('nama')
            ->get()
            ->map(function ($tipe) {
                return [
                    'id' => $tipe->id,
                    'text' => ucwords($tipe->text)
                ];
            });

        $status = $tipes->isEmpty() ? 'Not Found' : 'Found';

        return response()->json([
            'status' => $status,
            'data' => $tipes
        ]);
    }

    public function searchKotak($kategori = null, $search = null)
    {

        $search = explode(' ', $search, 2);
        $jenis = $search[0];
        $nomor = count($search) == 2 ? (int)$search[1] : '';
        $userCabangId = Auth::check() ? Auth::user()->cabang_id : 1;

        $tipes = Kotak::with('blok')->where('kategori_id', $kategori)
            ->where('nomor', 'like', "%$nomor%")
            ->where('jenis', 'like', "%$jenis%")
            ->when($userCabangId, function ($query, $userCabangId) {
                $query->whereHas('blok', function ($query) use ($userCabangId) {
                    $query->where('cabang_id', $userCabangId);
                });
            })
            ->select('id')
            ->selectRaw('CONCAT(jenis," ",nomor) as text')
            ->orderBy('text')
            ->get();

        $status = $tipes->isEmpty() ? 'Not Found' : 'Found';

        return response()->json([
            'status' => $status,
            'data' => $tipes
        ]);
    }

    public function searchProduk($produk = null)
    {
        $split = explode('-', $produk);
        $kodeTipe = $split[0];
        $produkId = $split[1];

        $searchProduk = Produk::with('tipe', 'karat.harga_ref')
            ->where('id', 'LIKE', "$produkId%")
            ->where('status_id',  1)
            ->whereHas('tipe', fn ($query) => $query->where('kode_tipe', $kodeTipe))
            ->whereHas('karat.harga_ref', fn ($query) => $query->where('status', 1))
            ->first();

        $status = $searchProduk ? 'Found' : 'Not Found';

        return response()->json([
            'status' => $status,
            'data' => $searchProduk ? [
                'id' => $searchProduk->id,
                'tipe' => ucwords($searchProduk->tipe->nama),
                'berat' => $searchProduk->berat,
                'karat' => $searchProduk->karat->nama,
                'harga_ref' => $searchProduk->karat->harga_ref->pluck('harga')
            ] : null
        ]);
    }

    public function searchMember($member = null)
    {
        $dataMember = Member::where('hp', $member)->first();
        $status = $dataMember ? 'Found' : 'Not Found';

        return response()->json([
            'status' => $status,
            'data' => $dataMember
        ]);
    }
}
