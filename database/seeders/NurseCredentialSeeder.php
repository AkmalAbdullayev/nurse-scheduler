<?php

namespace Database\Seeders;

use App\Models\NurseCredential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NurseCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $credentials = [
            'Certified Nursing Assistant (CNA)',
            'Licensed Practical Nurse (LPN)',
            'Licensed Vocational Nurse (LVN)',
            'Registered Nurse(RN)',
            'Advanced Practice Registered Nurse(APRN)',
            'Surgical Assistant Registered Nurse',
            'Home Care Registered Nurse',
            'Emergency Room Registered Nurse',
            'Labor and Delivery Nurse',
            'Clinical Nurse Supervisor',
            'Nurse case Manager',
            'Critical Care Registered Nurse',
            'Oncology Registered Nurse',
            'Health Informatics Nurse Specialist',
            'Clinical Nurse Specialist',
            'Nurse Practitioner(NP)',
            'Nurse Educator',
        ];

        foreach ($credentials as $credential) {
            NurseCredential::query()->create([
                'name' => $credential
            ]);
        }
    }
}
