<?php

namespace App\Exports;

use App\Models\Nurse;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NursesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Nurse::query()->with(['state', 'role', 'borough'])->get();
    }

    public function map($nurse): array
    {
        return [
            'id' => $nurse?->id,
            'first_name' => $nurse?->first_name,
            'mi' => $nurse?->mi,
            'last_name' => $nurse?->last_name,
            'street_address_1' => $nurse?->street_address_1,
            'street_address_2' => $nurse?->street_address_2,
            'city' => $nurse?->city,
            'state' => $nurse?->state->name,
            'zip_code' => $nurse?->zip_code,
            'email' => $nurse?->email,
            'cell_number' => $nurse?->cell_number,
            'office_phone' => $nurse?->office_phone,
            'license_number' => $nurse?->license_number,
            'special_notes' => $nurse?->special_notes,
            'active_for_assignments' => $nurse?->active_for_assignments,
            'assigned_date' => $nurse?->assigned_date,
            'role' => $nurse->role?->name,
            'borough_id' => $nurse->borough?->name,
            'deleted_at' => $nurse?->deleted_at
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'first_name',
            'mi',
            'last_name',
            'street_address_1',
            'street_address_2',
            'city',
            'state',
            'zip_code',
            'email',
            'cell_number',
            'office_phone',
            'license_number',
            'special_notes',
            'active_for_assignments',
            'assigned_date',
            'role',
            'borough',
            'deleted_at'
        ];
    }
}
