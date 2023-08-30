<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_transaksis = [
            ['nama' => 'Jual'],
            ['nama' => 'Beli'],
            ['nama' => 'Tukar Tambah'],
            ['nama' => 'Pindah Nota'],
        ];

        DB::table('jenis_transaksis')->insert($jenis_transaksis);
    }
}
