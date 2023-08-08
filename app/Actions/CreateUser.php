<?php

namespace App\Actions;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser
{
    /**
     * @param Nurse $nurse
     * @param object $role
     * @return array
     */
    public function handle(Nurse $nurse, object $role): array
    {
        $generatedPassword = Str::random(8);

        $user = User::query()->create([
            'cell_number' => $nurse->cell_number,
            'password' => Hash::make($generatedPassword),
        ])->assignRole($role->name);

        return [
            'user' => $user,
            'password' => $generatedPassword
        ];
    }
}
