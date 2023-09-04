<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KotakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kotak = [
            [
                'nomor' => 1,
                'jenis' => 'Kotak',
                'berat' => 200,
                'blok_id' => 1,
                'kategori_id' => 1
            ],
            [
                'nomor' => 2,
                'jenis' => 'Kotak',
                'berat' => 200,
                'blok_id' => 2,
                'kategori_id' => 1
            ], [
                'nomor' => 1,
                'jenis' => 'Kotak',
                'berat' => 200,
                'blok_id' => 1,
                'kategori_id' => 2
            ],
            [
                'nomor' => 2,
                'jenis' => 'Kotak',
                'berat' => 200,
                'blok_id' => 2,
                'kategori_id' => 2
            ]
        ];

        DB::table('kotaks')->insert($kotak);
    }
}
