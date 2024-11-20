<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmMember>
 */
class FarmMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'association_id' => rand(1, 10), // Assuming you have associations with IDs from 1 to 10
            'president_id' => User::factory(), // Assuming the president is also a user
            'contact_number' => fake()->phoneNumber,
            'address' => fake()->address,
            'city' => fake()->city,
            'provice' => fake()->state, // Note: there's a typo in your schema 'provice' should be 'province'
            'zip_code' => 1234,
            'barangay' => fake()->word,
            'photo' => fake()->imageUrl(), // You can customize this to point to a specific image storage
        ];
    }
}
