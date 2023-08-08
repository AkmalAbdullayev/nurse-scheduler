<?php

namespace App\Actions;

use App\Models\Nurse;
use Illuminate\Support\Facades\Hash;

class UpdatePassword
{
    /**
     * @param Nurse $nurse
     * @param string $password
     * @return int
     */
    public function handle(Nurse $nurse, string $password): int
    {
        return $nurse->user()->update([
            'password' => Hash::make($password)
        ]);
    }
}
