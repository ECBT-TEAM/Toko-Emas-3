<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kondisi = [
            ['kode' => 'TPS', 'nama' => 'Tepos'],
            ['kode' => 'MLT', 'nama' => 'Meleyot'],
            ['kode' => 'BLG', 'nama' => 'Bolong'],
            ['kode' => 'PTR', 'nama' => 'Patri'],
            ['kode' => 'ODT', 'nama' => 'Orang tidak tahu'],
            ['kode' => 'OT', 'nama' => 'Orang tahu'],
            ['kode' => 'PTS', 'nama' => 'Putus'],
            ['kode' => 'PCH', 'nama' => 'Pecah'],
            ['kode' => 'DKK', 'nama' => 'Dekok'],
            ['kode' => 'MT HLG', 'nama' => 'Mata hilang'],
            ['kode' => 'CWL', 'nama' => 'Cuwil'],
            ['kode' => 'RGG', 'nama' => 'Renggang'],
            ['kode' => 'PTR TLDS', 'nama' => 'Patri tali dasi'],
            ['kode' => 'SSHN', 'nama' => 'Sisian'],
            ['kode' => 'UHU', 'nama' => 'Uhu'],
            ['kode' => 'GPP', 'nama' => 'Gapapa'],
            ['kode' => 'BRMLS', 'nama' => 'Baru Mulus'],
            ['kode' => 'CTT', 'nama' => 'Cacat'],
            ['kode' => 'KTR', 'nama' => 'Kitir'],
            ['kode' => 'PGGR', 'nama' => 'Pinggir'],
        ];

        DB::table('kondisis')->insert($kondisi);
    }
}
