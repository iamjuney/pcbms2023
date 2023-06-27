<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'prod_name' => 'required|string|max:50',
            'shelf_life' => 'required|integer|min:0',
            'unit' => 'required|in:piece,pack,bottle,bag',
            'appreciation' => 'required|numeric|between:0,99.99',
            'max_lvl' => 'required|integer|min:0',
        ];
    }
}
