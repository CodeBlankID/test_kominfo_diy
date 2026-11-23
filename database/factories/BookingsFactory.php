<?php

namespace Database\Factories;

use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bookings>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'room_id'    => fake()->numberBetween( 1, 10 ),
            'user_id'    => fake()->numberBetween( 1, 10 ),
            'title'      => fake()->catchPhrase(),
            'start_time' => Carbon::today(),
            'end_time'   => Carbon::tomorrow(),
            'status'     => fake()->randomElement( [ "CONFIRMED", "CANCELLED" ] ),
        ];
    }
}
