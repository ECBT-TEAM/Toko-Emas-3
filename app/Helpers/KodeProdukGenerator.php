<?php

use App\Models\Tipe;
use App\Models\Kategori;

function generateKodeProduk($kategoriId)
{

    $kategori = Kategori::find($kategoriId);
    $tipe = $kategori ? $kategori->tipe()->latest()->first() : null;

    $kode = $kategori ? $kategori->kode : '';
    $id = $tipe ? $tipe->id + 1 : 1;

    $formattedNumber = $kode . str_pad($id, 5, '0', STR_PAD_LEFT);
    return $formattedNumber;
}
