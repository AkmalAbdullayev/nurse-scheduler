<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'building_code' => fake()->buildingNumber,
            'district' => fake()->randomElement([
                'Czech Village',
                'Fort Bragg Unified School District',
                'Illinois Medical District',
                'Kingston Village',
                'New Bohemia',
                'Professorville Historic District'
            ]),
            'primary_dbn' => fake()->text,
            'school_name' => fake()->text,
            'street_address_1' => fake()->address,
            'street_address_2' => fake()->address,
            'city' => fake()->city,
            'state_id' => fake()->numberBetween(1, 50),
            'borough_id' => fake()->numberBetween(1, 5),
            'zip_code' => fake()->numberBetween([10000, 99999]),
            'google_map' => fake()->text,
            'school_phone' => fake()->phoneNumber,
            'special_notes' => fake()->text,
            'email' => fake()->email
        ];
    }
}
