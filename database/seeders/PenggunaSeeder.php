<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penggunas')->insert([
            [
                'nama' => "admin",
                "alamat" => "ciledug",
                "id_user" => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                // 'no_telfon' => '081234567891',
                'nama' => "sumanto",
                "alamat" => "ciledug",
                "id_user" => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
