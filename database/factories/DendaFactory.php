<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Denda>
 */
class DendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'id_denda' => 'DND-1',
            // 'kategori_denda' => 'Terlambat',
            // 'biaya' => 1000,
        ];
    }
}