<?php

use App\Models\Kategori;
use Intervention\Image\Facades\Image;
use Picqer\Barcode\BarcodeGeneratorPNG;

function generateKodeProduk($kategoriId)
{

    $kategori = Kategori::find($kategoriId);
    $tipe = $kategori ? $kategori->tipe()->latest()->first() : null;

    $kode = $kategori ? $kategori->kode : '';
    $id = $tipe ? $tipe->id + 1 : 1;

    $formattedNumber = $kode . str_pad($id, 5, '0', STR_PAD_LEFT);
    return $formattedNumber;
}


function generateBarcode($text)
{
    $generator = new BarcodeGeneratorPNG();

    $barcode = $generator->getBarcode($text, $generator::TYPE_EAN_13);
    $image = Image::make('data:image/png;base64,' . base64_encode($barcode));
    $image->resize(300);

    // Mengembalikan gambar dalam bentuk data base64 yang lebih kecil
    return $image->encode('data-url');
}
