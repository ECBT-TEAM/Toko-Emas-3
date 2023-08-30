<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['kode_transaksi', 'member_id', 'kasir_id', 'jenis_transaksi_id'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->kode_transaksi = Uuid::uuid4()->toString();
        });
    }

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'kode_transaksi');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'kasir_id');
    }

    public function jenisTransaksi()
    {
        return $this->belongsTo(jenisTransaksi::class, 'jenis_transaksi_id');
    }
}
