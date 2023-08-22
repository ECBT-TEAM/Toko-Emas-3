<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    public function kotak()
    {
        return $this->hasMany(Kotak::class, 'kategori_id');
    }
}
