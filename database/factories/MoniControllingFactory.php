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
            'nilai_humidity' => fake()->randomFloat(2, 0, 100),
            'nilai_temperature' => fake()->randomFloat(2, 0, 100),
            'created_at' => now()->addDays(rand(0, 7))->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
            'updated_at' => now()->addDays(rand(0, 7))->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
        ];
    }
}
