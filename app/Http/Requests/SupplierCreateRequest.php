<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company' => 'required|string|max:50',
            'contact_person' => 'required|string|max:50',
            'sex' => 'required|in:Male,Female,Non-binary',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:100',
        ];
    }
}
