<?php

namespace App\Models;

use App\Http\Controllers\HargaRefController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karat extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    public function harga_ref()
    {
        return $this->hasMany(harga_ref::class, 'karat_id');
    }
}
