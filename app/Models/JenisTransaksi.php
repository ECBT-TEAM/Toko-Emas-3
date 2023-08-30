<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];


    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class, 'transaksi_id');
    }
}
