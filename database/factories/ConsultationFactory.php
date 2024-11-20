<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
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
            'agriculture_id' => User::factory(), // Assuming agriculture_id is also a user
            'farmer_fullname' => fake()->name,
            'title' => fake()->sentence(6),
            'concern' => fake()->paragraph,
            'location' => fake()->address,
            'status' => fake()->randomElement(['Submitted', 'Under Review', 'Resolve']),
            'schedule' => fake()->dateTimeBetween('now', '+1 month'), // Random date-time in the next month
        ];
    }
}
