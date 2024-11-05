<?php

namespace Database\Factories;

use App\Models\Alat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Monicontrolling>
 */
class MonitoringControllingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_alat' => Alat::inRandomOrder()->first()->id,
            'nilai_humidity' => fake()->float(2, 0, 100),
            'nilai_temperature' => fake()->float(2, 0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
