<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin1234'),
                'cabang_id' => 1,
                'role_id' => 1,
                'status' => 1,
            ], [
                'nama' => 'Admin2',
                'username' => 'admin2',
                'password' => bcrypt('admin1234'),
                'cabang_id' => 2,
                'role_id' => 1,
                'status' => 1,
            ], [
                'nama' => 'Kasir',
                'username' => 'kasir',
                'password' => bcrypt('kasir1234'),
                'cabang_id' => 1,
                'role_id' => 3,
                'status' => 1,
            ],
        ];

        DB::table('users')->insert($user);
    }
}
