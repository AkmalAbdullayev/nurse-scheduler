<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'building_code' => ['required', 'numeric'],
            'district' => ['required', 'string'],
            'primary_dbn' => ['required', 'string'],
            'school_name' => ['required', 'string'],
            'street_address_1' => ['required', 'string'],
            'street_address_2' => ['string', 'nullable'],
            'city' => ['required', 'string'],
            'state_id' => ['required', 'integer'],
            'zip_code' => ['required', 'integer', 'min:5'],
            'borough_id' => ['required', 'integer'],
            'school_phone' => ['required', 'string'],
            'google_map' => ['string', 'nullable'],
            'principals' => ['array', 'nullable'],
            'principals.name' => [
                Rule::requiredIf(request()->filled('principals.cell_number')),
                Rule::requiredIf(request()->filled('principals.email'))
            ],
            'principals.cell_number' => [
                Rule::requiredIf(request()->filled('principals.name')),
                Rule::requiredIf(request()->filled('principals.email'))
            ],
            'principals.email' => [
                Rule::requiredIf(request()->filled('principals.name')),
                Rule::requiredIf(request()->filled('principals.cell_number'))
            ],
            'special_notes' => ['string', 'nullable'],
            'assignment_priority' => ['string', Rule::in(['a', 'b', 'c', 'd', 'e', 'f']), 'nullable'],
            'is_active' => ['boolean', 'nullable'],
            'nurses' => ['array', 'nullable'],
            'medical_needs' => ['array', 'nullable']
        ];
    }
}
