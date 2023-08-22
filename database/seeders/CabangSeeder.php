<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabang = [
            [
                'nama' => 'Sinar Jaya - psrn',
                'Alamat' => 'Pasuruan'
            ], [
                'nama' => 'Sinar Jaya - mlg',
                'Alamat' => 'Malang'
            ], [
                'nama' => 'Sinar Jaya - sby',
                'Alamat' => 'Surabaya'
            ],
        ];

        DB::table('cabangs')->insert($cabang);
    }
}
