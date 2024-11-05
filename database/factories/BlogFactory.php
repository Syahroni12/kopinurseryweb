<?php

namespace Database\Factories;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'category' => fake()->randomElement(['Tech', 'News', 'Agriculture']),
            'content' => fake()->paragraph(),
            'image' => 'image.png',
            'id_pengguna' => Pengguna::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
