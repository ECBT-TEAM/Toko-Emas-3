<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = [
            ['nama' => 'ubs', 'pabrik' => 'UBS', 'alamat' => 'pasuruan'],
            ['nama' => 'kr', 'pabrik' => 'KR', 'alamat' => 'pasuruan'],
            ['nama' => 'auva', 'pabrik' => 'AUVA', 'alamat' => 'pasuruan'],
        ];

        DB::table('suppliers')->insert($supplier);
    }
}
