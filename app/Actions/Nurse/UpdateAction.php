<?php

namespace App\Actions\Nurse;

use App\Actions\UpdatePassword;
use App\Models\Borough;
use App\Models\Nurse;
use Spatie\Permission\Models\Role;

class UpdateAction
{
    /**
     * @param array $request
     * @param Nurse $nurse
     * @return array
     */
    public function handle(array $request, Nurse $nurse): array
    {
        $nurses = Nurse::query()->get();

        $isExistsNurse = $nurses
            ->where('id', '!=', $nurse->id)
            ->contains('cell_number', '=', '+1' . $request['cell_number']);

        if ($isExistsNurse) {
            return [
                'message' => 'User already exists.',
                'value' => false
            ];
        }

        if ($nurse->update($request)) {
            $nurse->user()->update([
                'cell_number' => $nurse->cell_number
            ]);

            if (!isset($request['active_for_assignments'])) {
                $nurse->active_for_assignments = 0;
                $nurse->saveQuietly();
            }

            if (isset($request['boroughs'])) {
                $boroughIds = collect();
                foreach ($request['boroughs'] as $k => $borough) {
                    $boroughIds->push([
                        'is_primary' => $k == 'primary' ? 1 : 0,
                        'borough_id' => $borough
                    ]);
                }

                $diffValues = $boroughIds->pluck('borough_id')->diff($nurse->desired_boroughs->pluck('pivot.borough_id'));
                $diffValues = $boroughIds->whereIn('borough_id', $diffValues);

                $nurse->desired_boroughs()->attach($diffValues);
            }

            if (isset($request['credentials'])) {
                $credentials = collect();

                foreach ($request['credentials'] as $credential) {
                    $credentials->push($credential);
                }

                $nurse->credentials()->sync($credentials);
            }

            if (isset($request['medical_needs'])) {
                $medicalNeedsIds = [];

                foreach ($request['medical_needs'] as $medicalNeed) {
                    $medicalNeedsIds[] = $medicalNeed;

                    $nurse->medical_needs()->syncWithoutDetaching($medicalNeedsIds);
                }
            }

            if (isset($request['new_password'])) {
                (new UpdatePassword())->handle($nurse, $request['new_password']);
            }

            if (isset($request['role'])) {
                $role = Role::query()->where('name', '=', $request['role'])->first();
                $nurse->role_id = $role->id;
                $nurse->user?->syncRoles($role->name);
                $nurse->saveQuietly();
            }

            $nurse->user()->update([
                'cell_number' => $nurse->cell_number
            ]);

            return [
                'message' => 'User successfully updated.',
                'value' => true
            ];
        }

        return [
            'message' => 'Error!!!',
            'value' => false
        ];
    }
}
