<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['id', 'berat', 'tipe_id', 'karat_id', 'supplier_id', 'kotak_id', 'status_id'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    // Define relationships
    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id');
    }

    public function karat()
    {
        return $this->belongsTo(Karat::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function kotak()
    {
        return $this->belongsTo(Kotak::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
