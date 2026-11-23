<?php

namespace Database\Factories;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rooms>
 */
class RoomsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'name'      => fake()->name(),
            'capacity'  => fake()->numberBetween( 10, 20 ),
            'is_active' => fake()->boolean(),
        ];
    }
}
