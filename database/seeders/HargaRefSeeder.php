<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HargaRefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karat8 = [500000, 525000, 550000, 575000, 600000, 625000, 650000, 675000, 700000, 725000, 750000];
        $karat9 = [550000, 575000, 600000, 625000, 650000, 675000, 700000, 725000, 750000, 775000, 800000];
        $karat16 = [750000, 775000, 800000, 825000, 850000, 875000, 900000, 925000, 950000, 975000, 1000000, 1025000, 1050000, 1100000, 1150000];
        $karat17 = [800000, 825000, 850000, 875000, 900000, 925000, 950000, 975000, 1000000, 1050000, 1100000, 1150000, 1200000, 1250000, 1300000];
        $karat23 = [1100000, 1200000, 1300000, 1400000, 1500000];


        foreach ($karat8 as $harga) {
            $hargaRef[] = ['karat_id' => 1, 'harga' => $harga];
        }

        foreach ($karat9 as $harga) {
            $hargaRef[] = ['karat_id' => 2, 'harga' => $harga];
        }

        foreach ($karat16 as $harga) {
            $hargaRef[] = ['karat_id' => 3, 'harga' => $harga];
        }

        foreach ($karat17 as $harga) {
            $hargaRef[] = ['karat_id' => 4, 'harga' => $harga];
        }

        foreach ($karat23 as $harga) {
            $hargaRef[] = ['karat_id' => 5, 'harga' => $harga];
        }

        DB::table('harga_refs')->insert($hargaRef);
    }
}
