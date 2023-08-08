<?php

namespace App\Actions\Nurse;

use App\Actions\CreateUser;
use App\Events\NurseCreated;
use App\Models\Nurse;
use App\Models\User;
use Spatie\Permission\Models\Role;

class StoreAction
{
    public function __construct(private readonly CreateUser $createUser)
    {
    }

    public function handle(array $data): array
    {
        $nurseModel = new Nurse();
        $nurseModel->cell_number = '+1' . request()->input('cell_number');
//        $nurseModel->office_phone = $data['office_phone'];
        $nurseModel->first_name = $data['first_name'] ?? null;
        $nurseModel->last_name = $data['last_name'] ?? null;
        $nurseModel->mi = $data['mi'] ?? null;
        $nurseModel->street_address_1 = $data['street_address_1'] ?? null;
        $nurseModel->street_address_2 = $data['street_address_2'] ?? null;
        $nurseModel->city = $data['city'] ?? null;
        $nurseModel->state_id = $data['state_id'] ?? null;
        $nurseModel->borough_id = $data['borough_id'] ?? null;
        $nurseModel->zip_code = $data['zip_code'] ?? null;
        $nurseModel->email = $data['email'] ?? null;
        $nurseModel->license_number = $data['license_number'] ?? null;
        $nurseModel->special_notes = $data['special_notes'] ?? null;
        $role = Role::query()->where('name', '=', $data['role'])->first();
        $nurseModel->role_id = $role->id;
        $nurseModel->active_for_assignments = $data['active_for_assignments'] ?? 0;

        $nurses = Nurse::withTrashed()->get();
        $numberExists = $nurses->contains('cell_number', '=', $nurseModel->cell_number);

        $user = User::query()->where('cell_number', '=', $nurseModel->cell_number)->exists();

        if ($numberExists || $user) {
            return [
                'message' => 'Change cell number or delete nurse, we cannot reuse the cell number.',
                'value' => false
            ];
        }

        $user = $this->createUser->handle($nurseModel, $role);
        $nurseModel->user_id = $user['user']->id;

        if ($nurseModel->save()) {
            $boroughIds = [];

            if (isset($data['boroughs'])) {
                foreach ($data['boroughs'] as $k => $borough) {
                    $boroughIds[] = [
                        'is_primary' => $k == 'primary' ? 1 : 0,
                        'borough_id' => $borough
                    ];
                }

                $nurseModel->desired_boroughs()->toggle($boroughIds);
            }

            if (isset($data['credentials'])) {
                $credentialIds = [];
                foreach ($data['credentials'] as $credential) {
                    $credentialIds[] = $credential;
                }

                $nurseModel->credentials()->attach($credentialIds);
            }

            if (isset($data['medical_needs'])) {
                $medicalNeedsIds = [];
                foreach ($data['medical_needs'] as $medicalNeed) {
                    $medicalNeedsIds[] = $medicalNeed;
                }

                $nurseModel->medical_needs()->syncWithoutDetaching($medicalNeedsIds);
            }

            NurseCreated::dispatch($nurseModel, $user['password']);

            return [
                'message' => 'Nurse successfully created.',
                'value' => true
            ];
        }

        return [
            'message' => 'Error',
            'value' => false
        ];
    }
}
