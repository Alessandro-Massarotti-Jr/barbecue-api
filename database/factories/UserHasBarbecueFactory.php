<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserHasBarbecue>
 */
class UserHasBarbecueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paid' => (bool)rand(0, 1),
            'with_drink' => (bool)rand(0, 1),
        ];
    }
}
