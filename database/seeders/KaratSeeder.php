<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karat = [
            ['kode' => 'BBR', 'nama' => '8'],
            ['kode' => 'BBR', 'nama' => '9'],
            ['kode' => 'BBR', 'nama' => '16'],
            ['kode' => 'BBR', 'nama' => '17'],
            ['kode' => 'BBR', 'nama' => '23'],
        ];

        DB::table('karats')->insert($karat);
    }
}
