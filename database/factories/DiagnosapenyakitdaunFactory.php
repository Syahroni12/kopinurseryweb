<?php

namespace Database\Factories;

use App\Models\User;
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
            'id_user' => User::inRandomOrder()->first()->id,
            'file' => 'masonry (' . fake()->numberBetween(1, 10) . ').jpg',
            'diagnosa' => fake()->randomElement(['Miner', 'Nodisease', 'Rust', 'Phoma']),
            'keakuratan' => fake()->randomFloat(2, 0, 100),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
