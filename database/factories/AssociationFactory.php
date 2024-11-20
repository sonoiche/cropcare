<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Association>
 */
class AssociationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'president_id' => User::factory(), // Assuming the president is also a user
            'user_id' => User::factory(), // Create a user for the association
            'name' => fake()->company, // You can change this to any other relevant name
        ];
    }
}
