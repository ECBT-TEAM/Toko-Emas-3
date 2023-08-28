<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'pabrik', 'alamat'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'supplier_id');
    }
}
