<?php

namespace App\Imports;

use App\Actions\CreateUser;
use App\helpers\Facades\Twilio;
use App\Models\Borough;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\State;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class NursesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    private Collection $nurses;
    private Collection $users;
    private Collection $roles;
    private Collection $boroughs;
    private Collection $states;

    public function __construct()
    {
        $this->nurses = Nurse::withTrashed()->get();
        $this->users = User::query()->get();
        $this->roles = Role::query()->get();
        $this->boroughs = Borough::query()->get();
        $this->states = State::query()->get();
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $createdNurses = collect();

        $rows->map(function ($value) use ($createdNurses) {
            if (is_null($value['first_name']))
                return null;

            $boroughIds = collect();
            $credentialIds = collect();
            $medicalSkills = collect();

            if ($value->has('desired_primary_borough') && !is_null($value['desired_primary_borough'])) {
                $primaryBorough = Borough::query()->where('name', '=', $value['desired_primary_borough'])->first()?->id;

                $boroughs = Borough::query()
                    ->whereIn('name', [
                        $value['desired_secondary_borough'],
                        $value['desired_third_borough'],
                        $value['desired_fourth_borough'],
                        $value['desired_fifth_borough']
                    ])
                    ->get()
                    ->pluck('id');

                $boroughIds[] = ['is_primary' => 1, 'borough_id' => $primaryBorough];

                foreach ($boroughs as $borough) {
                    $boroughIds[] = [
                        'is_primary' => 0,
                        'borough_id' => $borough
                    ];
                }
            }

            if ($value->has('nurse_credential_1') && !is_null($value['nurse_credential_1'])) {
                $credentialIds = NurseCredential::query()->whereIn('name', [
                    $value['nurse_credential_1'],
                    $value['nurse_credential_2'],
                    $value['nurse_credential_4'],
                    $value['nurse_credential_5'],
                    $value['nurse_credential_6'],
                    $value['nurse_credential_7'],
                    $value['nurse_credential_8'],
                    $value['nurse_credential_9'],
                    $value['nurse_credential_10'],
                ])
                    ->get()
                    ->pluck('id');
            }

            if ($value->has('medical_skill_1') && !is_null($value['medical_skill_1'])) {
                $medicalSkills = MedicalNeed::query()->whereIn('name', [
                    $value['medical_skill_1'],
                    $value['medical_skill_2'],
                    $value['medical_skill_3'],
                    $value['medical_skill_4'],
                    $value['medical_skill_5']
                ])
                    ->get()
                    ->pluck('id');
            }

            $numberExists = $this->nurses->contains('cell_number', '=', '+1' . $value['cell_phone']);
            $user = $this->users->contains('cell_number', '=', '+1' . $value['cell_phone']);

            if (!$numberExists && !$user) {
                $role = $this->roles->where('name', '=', $value['role'])->first();

                $nurse = Nurse::query()->create([
                    'first_name' => $value['first_name'],
                    'mi' => $value['middle_name'],
                    'last_name' => $value['last_name'],
                    'cell_number' => str_replace(['(', ')', ' ', '-'], '', substr_replace($value['cell_phone'], '+1', 0, 0)),
                    'email' => $value['email_address'],
                    'license_number' => $value['license_number'],
                    'street_address_1' => $value['street_address_1'],
                    'street_address_2' => $value['street_address_2'],
                    'city' => $value['city'],
                    'state_id' => $value['state'] ? $this->states->where('name', '=', $value['state'])->first()->id : null,
                    'borough_id' => $value['borough'] ? $this->boroughs->where('name', '=', $value['borough'])->first()?->id : null,
                    'zip_code' => $value['zipcode'],
                    'special_notes' => $value['special_notes'],
                    'role_id' => $role?->id,
                    'active_for_assignments' => $value['status'],
                ]);

                $createdNurses->push($nurse);

                $user = (new CreateUser())->handle($nurse, $role);
                $nurse->user_id = $user['user']->id;
                $nurse->saveQuietly();

                $nurse->desired_boroughs()->toggle($boroughIds);
                $nurse->credentials()->attach($credentialIds);
                $nurse->medical_needs()->syncWithoutDetaching($medicalSkills);

                $password = $user['password'];
                $url = "https://doescheduling.ssd.uz";

                Twilio::send($nurse->cell_number, "$password is your password for $url. Use it to validate your login.");
            }
        });
    }

    public function headingRow(): int
    {
        return 2;
    }
}
