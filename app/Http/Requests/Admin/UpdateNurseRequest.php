<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNurseRequest extends FormRequest
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
            'cell_number' => ['required', 'numeric'],
            'office_phone' => ['numeric', 'nullable'],
            'first_name' => ['required', 'string'],
            'mi' => ['string', 'nullable'],
            'last_name' => ['required', 'string'],
            'street_address_1' => ['nullable', 'string'],
            'street_address_2' => ['string', 'nullable'],
            'city' => ['nullable', 'string'],
            'state_id' => ['nullable', 'integer'],
            'borough_id' => ['integer', Rule::requiredIf(request()->boolean(key: 'active_for_assignments'))],
            'zip_code' => ['nullable', 'min:5', 'numeric'],
            'email' => ['required', 'email'],
            'license_number' => [Rule::requiredIf(request()->boolean(key: 'active_for_assignments')), 'numeric'],
            'special_notes' => ['string', 'nullable'],
            'role' => ['string', 'nullable'],
            'active_for_assignments' => ['boolean', 'nullable'],
            'assigned_date' => ['date', 'nullable'],
            'boroughs' => ['array', 'nullable'],
            'boroughs.primary' => [Rule::requiredIf(request()->boolean(key: 'active_for_assignments'))],
            'boroughs.*' => ['numeric', 'nullable'],
            'credentials' => ['array', 'nullable'],
            'credentials.primary' => ['required'],
            'credentials.*' => ['required'],
            'medical_needs' => ['array', 'nullable'],
            'is_active' => ['boolean', 'nullable'],
            'current_password' => ['nullable', 'string', 'min:6', 'current_password'],
            'new_password' => [Rule::requiredIf(request()->filled('current_password'))]
        ];
    }
}
