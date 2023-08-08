<?php

namespace App\Exports;

use App\Models\School;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SchoolsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return School::query()
            ->with(['state', 'borough', 'school_principal'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'building_code',
            'district',
            'primary_dbn',
            'school_name',
            'street_address_1',
            'street_address_2',
            'city',
            'state',
            'zip_code',
            'email',
            'borough_id',
            'school_phone',
            'google_map',
            'principal_id',
            'special_notes',
            'assignment_priority',
            'is_active',
            'deleted_at'
        ];
    }

    public function map($row): array
    {
        return [
            'id' => $row?->id,
            'building_code' => $row?->building_code,
            'district' => $row?->district,
            'primary_dbn' => $row?->primary_dbn,
            'school_name' => $row?->school_name,
            'street_address_1' => $row?->street_address_1,
            'street_address_2' => $row?->street_address_2,
            'city' => $row?->city,
            'state' => $row->state?->name,
            'zip_code' => $row?->zip_code,
            'email' => $row?->email,
            'borough_id' => $row->borough?->name,
            'school_phone' => $row?->school_phone,
            'google_map' => $row?->google_map,
            'principal_id' => $row->school_principal?->name,
            'special_notes' => $row?->special_notes,
            'assignment_priority' => $row?->assignment_priority,
            'is_active' => $row?->is_active,
            'deleted_at' => $row?->deleted_at
        ];
    }
}
