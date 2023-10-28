<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validate = [
            'name' => ['string', 'required', 'max:20', 'min:3'],
            'key' => ['string', 'required', 'unique:currencies,key', 'max:15', 'min:3'],
            'symbol' => ['string', 'nullable', 'max:255', 'min:3'],
            'iso_code' => ['string', 'nullable', 'max:255', 'min:3'],
            'is_active' => ['boolean', 'nullable']
        ];
        return $validate;
    }
}
