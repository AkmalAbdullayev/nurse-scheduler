<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::query()->create([
            'cell_number' => '+11234567899',
            'password' => Hash::make('admin123')
        ])->assignRole('Admin');

        User::query()->create([
            'cell_number' => '+12345678999',
            'password' => Hash::make('admin123')
        ])->assignRole('Admin');
    }
}
