<?php

namespace Database\Seeders;

use App\Models\MedicalNeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalNeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $medicalNeeds = [
            'Diabetic with Pump',
            'Catheterization',
            'Diabetic with Pen',
            'PO meds'
        ];

        foreach ($medicalNeeds as $medicalNeed) {
            MedicalNeed::query()->create([
                'name' => $medicalNeed
            ]);
        }
    }
}
