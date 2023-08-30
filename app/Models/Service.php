<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['produk_id', 'kondisi_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id');
    }
}
