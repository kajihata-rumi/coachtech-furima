<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'in:konbini,card'],
            'postal_code' => ['required'],
            'address' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'postal_code.required' => '配送先郵便番号を入力してください。',
            'address.required' => '配送先住所を入力してください。',
        ];
    }

}
