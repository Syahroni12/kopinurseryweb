<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosapenyakitdaun>
 */
class DiagnosapenyakitdaunFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diagnosa' => fake()->randomElement(['Miner', 'Nodisease', 'Rust', 'Phoma']),
            'image' => 'masonry (' . fake()->numberBetween(1, 10) . ').jpg',
            'gejala' => fake()->paragraph(),
            'solusi' => fake()->paragraph(),
        ];
    }
}
