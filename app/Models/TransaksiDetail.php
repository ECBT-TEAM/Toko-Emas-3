<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $fillable = ['kode_transaksi', 'produk_id', 'status'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi');
    }
}
