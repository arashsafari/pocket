<?php

namespace App\Http\Requests;

use App\Rules\Payment\CheckCurrencyExistsAndActive;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:0', 'not_in:0'],
            'currency_key' => ['required', new CheckCurrencyExistsAndActive()]
        ];

        return $validate;
    }
}
