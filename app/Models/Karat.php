<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karat extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    public function harga_ref()
    {
        return $this->hasMany(HargaRef::class, 'karat_id');
    }

    public function produk()
    {
        return $this->hasMany(produk::class, 'karat_id');
    }
}
