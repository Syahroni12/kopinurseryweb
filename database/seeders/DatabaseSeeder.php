<?php

namespace Database\Seeders;

use App\Models\Monicontrolling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
            UserSeeder::class,
            PenggunaSeeder::class,
            AlatSeeder::class,
            MoniControllingSeeder::class,
            BlogSeeder::class,
            DiagnosapenyakitdaunSeeder::class
        ]);
    }
}
