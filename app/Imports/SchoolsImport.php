<?php

namespace App\Imports;

use App\Models\Borough;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\School;
use App\Models\SchoolPrincipal;
use App\Models\State;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SchoolsImport implements ToCollection, WithHeadingRow
{
    use Importable, SkipsErrors;

    private Collection $states;
    private Collection $boroughs;
    private Collection $principals;
    private Collection $medicalNeeds;
    private Collection $nurses;

    public function __construct()
    {
        $this->states = State::query()->get();
        $this->boroughs = Borough::query()->get();
        $this->principals = SchoolPrincipal::query()->get();
        $this->medicalNeeds = MedicalNeed::query()->get();
        $this->nurses = Nurse::query()->get();
    }

    /**
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows): void
    {
        $rows->map(function ($value) {
            if (!isset($value['building_code']))
                return null;

            $school = School::query()->create([
                'building_code' => $value['building_code'],
                'district' => $value['district'],
                'primary_dbn' => $value['primary_dbn'],
                'school_name' => $value['school_name'],
                'school_phone' => str_contains($value['school_phone'], '+1')
                    ? str_replace(['(', ')', ' ', '-'], '', $value['school_phone'])
                    : str_replace(['(', ')', ' ', '-'], '', substr_replace($value['school_phone'], '+1', 0, 0)),
                'street_address_1' => $value['street_address_1'],
                'street_address_2' => $value['street_address_2'],
                'city' => $value['city'],
                'state_id' => is_string($value['state_id'])
                    ? $this->states->where('name', '=', $value['state_id'])->first()?->id
                    : $value['state_id'],
                'borough_id' => is_string($value['borough_id'])
                    ? $this->boroughs->where('name', '=', $value['borough_id'])->first()?->id
                    : $value['borough_id'],
                'zip_code' => $value['zip_code'],
                'email' => $value['email'] ?? null,
                'google_map' => array_key_exists('google_map_longitude', $value instanceof Collection ? $value->toArray() : $value)
                    ? $value['google_map_longitude']
                    : $value['google_map'],
                'principal_id' => array_key_exists('school_principal', $value instanceof Collection ? $value->toArray() : $value)
                    ? $this->principals->where('name', '=', $value['school_principal'])
                        ->where('email', '=', $value['principal_email'])
                        ->where('cell_number', '=', str_replace(['(', ')', ' ', '-'], '', substr_replace($value['principal_cell'], '+1', 0, 0)))
                        ->first()?->id
                    : $this->principals->where('id', '=', $value['principal_id'])->first()?->id,
                'assignment_priority' => $value['assignment_priority'] == 'NULL' ?? null,
                'special_notes' => $value['special_notes'],
                'is_active' => $value['is_active'] == 'NULL' ?? null,
            ]);

            if (array_key_exists('medical_needs', $value instanceof Collection ? $value->toArray() : $value) && !is_null($value['medical_needs_1'])) {
                $medicalNeedsIds = $this->medicalNeeds->whereIn('name', [
                    $value['medical_needs_1'],
                    $value['medical_needs_2'],
                    $value['medical_needs_3'],
                    $value['medical_needs_4'],
                    $value['medical_needs_5'],
                ])->pluck('id');

                $school->medical_needs()->syncWithoutDetaching($medicalNeedsIds);
            }

            if (array_key_exists('assigned_registered_nurse_office_phone', $value instanceof Collection ? $value->toArray() : $value) && !is_null($value['assigned_registered_nurse_office_phone'])) {
                $nurse = $this->nurses->where('office_phone', '=', str_replace(['(', ')', ' ', '-'], '', substr_replace($value['principal_cell'], '+1', 0, 0)))
                    ->first();

                if (!is_null($nurse)) {
                    $school->nurses()->attach($nurse->id);
                }
            }
        });
    }

    public function rules(): array
    {
        return [
            'district' => ['required', 'string'],
            'primary_dbn' => ['required', 'string'],
            'school_name' => ['required', 'string'],
            'street_address_1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state_id' => ['required'],
            'zip_code' => ['required', 'integer', 'min:5'],
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
