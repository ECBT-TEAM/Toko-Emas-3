<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'hp', 'alamat'];

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class, 'member_id');
    }
}
