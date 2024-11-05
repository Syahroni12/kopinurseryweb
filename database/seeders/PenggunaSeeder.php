<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $users->each(function ($user) {
            Pengguna::factory()->create([
                'nama' => fake()->name(),
                'alamat' => fake()->address(),
                'deskripsi' => fake()->sentence(10),
                'foto' => 'avatar.png',
                'id_user' => $user->id,
            ]);
        });
    }
}
