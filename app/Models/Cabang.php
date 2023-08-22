<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'alamat'];

    public function user()
    {
        return $this->hasMany(User::class, 'cabang_id');
    }

    public function blok()
    {
        return $this->hasMany(Blok::class, 'cabang_id');
    }
}
