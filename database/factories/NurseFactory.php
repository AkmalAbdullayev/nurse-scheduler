<?php

namespace Database\Factories;

use App\Models\Nurse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Nurse>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'street_address_1' => fake()->address(),
            'street_address_2' => fake()->address(),
            'city' => fake()->city(),
            'zip_code' => fake()->numberBetween(10000, 99999),
            'email' => fake()->email(),
            'cell_number' => fake()->phoneNumber(),
            'license_number' => fake()->numberBetween(100000, 999999),
            'special_notes' => fake()->text(100),
            'active_for_assignments' => fake()->randomElement([0, 1]),
            'assigned_date' => fake()->dateTime(),
            'state_id' => fake()->numberBetween(1, 50),
            'role_id' => fake()->numberBetween(1, 5),
            'borough_id' => fake()->numberBetween(1, 5)
        ];
    }
}
