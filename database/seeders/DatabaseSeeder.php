<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**ser
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CabangSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(KondisiSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(JenisTransaksiSeeder::class);
        $this->call(BlokSeeder::class);
        $this->call(KotakSeeder::class);
        $this->call(KaratSeeder::class);
        $this->call(HargaRefSeeder::class);
    }
}
