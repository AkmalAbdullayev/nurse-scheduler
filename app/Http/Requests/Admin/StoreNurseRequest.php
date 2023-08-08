<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNurseRequest extends FormRequest
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
            'cell_number' => ['required', 'string'],
            'office_phone' => ['nullable', 'string'],
            'first_name' => ['required', 'string'],
            'mi' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'street_address_1' => ['nullable', 'string'],
            'street_address_2' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state_id' => ['nullable', 'integer'],
            'borough_id' => [Rule::requiredIf(request()->boolean(key: 'active_for_assignments')), 'integer'],
            'zip_code' => ['nullable', 'min:5', 'numeric'],
            'email' => ['required', 'email', Rule::unique('nurses', 'email')->withoutTrashed()],
            'license_number' => [Rule::requiredIf(request()->boolean(key: 'active_for_assignments')), 'numeric'],
            'special_notes' => ['string', 'nullable'],
            'role' => ['string', 'required'],
            'active_for_assignments' => ['boolean', 'nullable'],
            'assigned_date' => ['date', 'nullable'],
            'boroughs' => ['array', 'nullable'],
            'boroughs.primary' => [Rule::requiredIf(request()->boolean(key: 'active_for_assignments'))],
            'boroughs.*' => ['numeric', 'nullable'],
            'credentials' => ['array', 'nullable'],
            'credentials.primary' => ['required'],
            'credentials.*' => ['numeric', 'nullable'],
            'medical_needs' => ['array', 'nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'cell_number.unique' => 'The cell phone has already been taken.'
        ];
    }
}
