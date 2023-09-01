<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blok = [
            ['nomor' => '1', 'cabang_id' => 1],
            ['nomor' => '2', 'cabang_id' => 1],
            ['nomor' => '3', 'cabang_id' => 1],
        ];

        DB::table('bloks')->insert($blok);
    }
}
