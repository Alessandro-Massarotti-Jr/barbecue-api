<?php

namespace Database\Seeders;

use App\Models\Barbecue;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarbecueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barbecue::factory(rand(1, 5))
            ->for(User::factory()->create(), 'owner')
            ->has(User::factory(rand(1, 20)), 'users')
            ->create();

        Barbecue::factory(rand(1, 5))
            ->for(User::factory()->create(), 'owner')
            ->has(User::factory(rand(1, 20)), 'users')
            ->create();

        Barbecue::factory(rand(1, 5))
            ->for(User::factory()->create(), 'owner')
            ->has(User::factory(rand(1, 20)), 'users')
            ->create();

        Barbecue::factory(rand(1, 5))
            ->for(User::factory()->create(), 'owner')
            ->has(User::factory(rand(1, 20)), 'users')
            ->create();
    }
}
