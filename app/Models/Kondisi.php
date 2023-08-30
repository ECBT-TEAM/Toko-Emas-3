<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    public function service()
    {
        return $this->hasMany(Service::class, 'kondisi_id');
    }
}
