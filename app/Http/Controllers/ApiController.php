<?php

namespace App\Http\Controllers;

use App\Models\Kotak;
use App\Models\Tipe;
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
}
