<?php

namespace Database\Seeders;

use App\Enums\Boroughs;
use App\Models\Borough;
use Illuminate\Database\Seeder;

class BoroughSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Boroughs::values() as $value) {
            Borough::query()->create([
                'name' => $value
            ]);
        }
    }
}
