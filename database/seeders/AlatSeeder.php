<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alats')->insert([
            [
                'alat' => "Alat 1",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 2",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 3",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 4",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 5",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 6",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alat' => "Alat 7",
                'deskripsi_alat' => fake()->sentence(10),
                'status' => fake()->randomElement([true, false]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
