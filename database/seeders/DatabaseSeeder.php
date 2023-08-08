<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            StateSeeder::class,
            BoroughSeeder::class,
            MedicalNeedsSeeder::class,
            SchoolSeeder::class,
            NurseSeeder::class,
            NurseCredentialSeeder::class
        ]);
    }
}
