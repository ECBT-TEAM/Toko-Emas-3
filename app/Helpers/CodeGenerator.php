<?php

use App\Models\Kategori;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


function generateKodeProduk($kategoriId)
{

    $kategori = Kategori::find($kategoriId);
    $tipe = $kategori ? $kategori->tipe()->latest()->first() : null;

    $kode = $kategori ? $kategori->kode : '';
    $id = $tipe ? $tipe->id + 1 : 1;

    $formattedNumber = $kode . str_pad($id, 5, '0', STR_PAD_LEFT);
    return $formattedNumber;
}


function generateBarcode($text, $size = 40)
{
    return QrCode::size($size)->generate($text);
}
