<?php

namespace Database\Seeders;

use Database\Factories\DiagnosapenyakitdaunFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosapenyakitdaunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiagnosapenyakitdaunFactory::new()->count(100)->create();
    }
}
