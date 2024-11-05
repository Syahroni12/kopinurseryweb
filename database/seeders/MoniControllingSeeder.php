<?php

namespace Database\Seeders;

use App\Models\Monicontrolling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoniControllingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Monicontrolling::factory(100)->create();
    }
}
