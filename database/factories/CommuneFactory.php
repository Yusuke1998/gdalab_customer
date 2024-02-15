<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_reg' => Region::inRandomOrder()->first()->id_reg,
            'description' => $this->faker->unique()->name()
        ];
    }
}
