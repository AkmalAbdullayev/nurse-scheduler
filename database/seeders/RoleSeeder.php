<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (UserRoles::toArray() as $value) {
            Role::query()->create([
                'name' => $value
            ]);
        }
    }
}
