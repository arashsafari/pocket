<?php

namespace App\Http\Requests;

use App\Rules\Payment\CheckCurrencyExistsAndActive;
use Illuminate\Foundation\Http\FormRequest;

class DepositTransferRequest extends FormRequest
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
            'base_user_id' => ['required', 'exists:users,id'],
            'target_user_id' => ['required', 'exists:users,id'],
            'currency_key' => ['required', new CheckCurrencyExistsAndActive()],
            'amount' => ['required', 'numeric', 'min:0', 'not_in:0'],
        ];

        return $validate;
    }
}
