<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['nama' => 'Baru'],
            ['nama' => 'Keranjang'],
            ['nama' => 'Terjual'],
            ['nama' => 'Balen'],
            ['nama' => 'Service'],
            ['nama' => 'Pindah Nota'],
        ];

        DB::table('statuses')->insert($statuses);
    }
}
