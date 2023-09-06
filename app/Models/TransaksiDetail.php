<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_transaksi',
        'produk_id',
        'harga',
        'jenis_transaksi_id',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function jenisTransaksi()
    {
        return $this->belongsTo(Status::class, 'jenis_transaksi_id');
    }
}
