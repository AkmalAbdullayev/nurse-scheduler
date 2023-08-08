<?php

namespace App\Http\Requests\Admin\CallOut;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfirmRequest extends FormRequest
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
            'nurse_id' => [Rule::requiredIf(!request()->boolean('nurses')), 'integer'],
            'school_id' => ['required', 'integer'],
            'date' => ['required'],
            'nurses' => ['boolean', 'nullable']
        ];
    }
}
