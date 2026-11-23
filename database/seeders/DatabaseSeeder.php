<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\User;
use Database\Factories\RoomsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        User::factory( 10 )->create();
        RoomsFactory::factory( 10 )->create();
        Bookings::factory( 10 )->create();
    }
}
