<?php

namespace Database\Seeders;

use App\Models\Monicontrolling;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitoringControllingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Monicontrolling::factory(100)->create();
    }
}
