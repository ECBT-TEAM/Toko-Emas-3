<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_transaksi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'metode_pembayaran',
        'norek',
        'member_id',
        'kasir_id',
        'cabang_id',
        'jenis_transaksi_id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->kode_transaksi = Uuid::uuid4()->toString();
        });
    }

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function jenisTransaksi()
    {
        return $this->belongsTo(JenisTransaksi::class, 'jenis_transaksi_id');
    }
}
