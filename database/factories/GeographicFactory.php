<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Geographic>
 */
class GeographicFactory extends Factory
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
            'association_id' => rand(1, 10), // Assuming you have associations with IDs from 1 to 10
            'farmer_id' => rand(1, 50), // Assuming you have farmers with IDs from 1 to 50
            'consultation_id' => rand(1, 20), // Assuming you have consultations with IDs from 1 to 20
            'name' => fake()->word,
            'description' => fake()->paragraph,
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
            'location' => fake()->address,
            'remarks' => fake()->text,
            'consultation' => fake()->text,
            'crop_name' => fake()->word,
            'crop_count' => fake()->numberBetween(1, 100),
            'crop_yield' => fake()->numberBetween(1, 1000),
            'status' => fake()->randomElement(['Available', 'Owned']),
            'consultaion_status' => fake()->randomElement(['Pending', 'Resolved']),
            'photo' => fake()->imageUrl(), // You can customize this to point to a specific image storage
            'created_at' => fake()->dateTimeBetween('2024-01-01', '2024-11-30'), // Random date between January and November 2024
            'updated_at' => fake()->dateTimeBetween('2024-01-01', '2024-11-30'), // Random date between January and November 2024
        ];
    }
}
