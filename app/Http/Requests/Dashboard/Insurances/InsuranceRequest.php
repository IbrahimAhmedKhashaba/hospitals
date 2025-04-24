<?php

namespace App\Http\Requests\Dashboard\Insurances;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsuranceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $insuranceId = $this->route('insurance');

        $rules = [
            'insurance_code' => [
                'required',
                'string',
                Rule::unique('insurances')->ignore($insuranceId, 'id'),
            ],
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'company_rate' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'insurance_code.required' => 'The insurance code field is required.',
            'insurance_code.unique' => 'The insurance code has already been taken.',
            'discount_percentage.required' => 'The discount percentage field is required.',
            'discount_percentage.numeric' => 'The discount percentage must be a number.',
            'discount_percentage.min' => 'The discount percentage must be at least 0.',
            'discount_percentage.max' => 'The discount percentage may not be greater than 100.',
            'company_rate.required' => 'The company rate field is required.',
            'company_rate.numeric' => 'The company rate must be a number.',
            'company_rate.min' => 'The company rate must be at least 0.',
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'notes.max' => 'The notes may not be greater than 1000 characters.',
        ];
    }
}
