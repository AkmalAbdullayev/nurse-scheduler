<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Nurse::factory()
            ->count(10)
//            ->for(City::factory()->create())
//            ->for(State::factory()->create())
            ->create()
            ->each(function ($nurse) {
                DB::table('borough_nurse')->insert([
                    'borough_id' => fake()->numberBetween(1, 5),
                    'nurse_id' => $nurse->id
                ]);
            });
    }
}
