<?php

namespace Database\Factories;

use App\Models\Alat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MoniControlling>
 */
class MoniControllingFactory extends Factory
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
            'nilai_humidity' => fake()->randomFloat(2, 0, 100), // Menggunakan randomFloat
            'nilai_temperature' => fake()->randomFloat(2, 0, 100), // Menggunakan randomFloat
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
