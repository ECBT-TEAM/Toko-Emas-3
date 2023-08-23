<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->hasMany(Produk::class, 'status_id');
    }
}
