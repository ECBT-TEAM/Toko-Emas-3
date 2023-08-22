<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class harga_ref extends Model
{
    use HasFactory;

    protected $fillable = ['harga', 'karat_id'];

    public function karat()
    {
        return $this->belongsTo(Karat::class, 'karat_id');
    }
}
