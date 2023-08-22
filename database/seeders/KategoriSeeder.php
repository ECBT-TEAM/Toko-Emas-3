<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['kode' => 'GKC', 'nama' => 'Gelang Keroncong + Cor'],
            ['kode' => 'KL', 'nama' => 'Kalung'],
            ['kode' => 'GLR', 'nama' => 'Gelang Rolek'],
            ['kode' => 'GLB', 'nama' => 'Gelang Bangkok'],
            ['kode' => 'CC', 'nama' => 'Cincin'],
            ['kode' => 'AT', 'nama' => 'Anting'],
            ['kode' => 'GW', 'nama' => 'Giwang'],
            ['kode' => 'LT', 'nama' => 'Liontin'],
        ];

        DB::table('kategoris')->insert($kategori);
    }
}
