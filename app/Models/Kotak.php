<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kotak extends Model
{
    use HasFactory;

    protected $fillable = ['nomor', 'jenis', 'berat', 'blok_id', 'kategori_id'];

    public function blok()
    {
        return $this->belongsTo(Blok::class, 'blok_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
