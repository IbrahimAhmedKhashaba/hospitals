<?php

namespace App\Http\Requests\Dashboard\Finance;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'The patient field is required.',
            'patient_id.exists' => 'The selected patient is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }
}
