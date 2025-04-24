<?php

namespace App\Http\Requests\DoctorDashboard;

use Illuminate\Foundation\Http\FormRequest;

class ConversionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|string',
            'invoice_id' => 'required|exists:invoices,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'invoice_id.required' => 'The invoice field is required.',
            'invoice_id.exists' => 'The selected invoice is invalid.',
            'patient_id.required' => 'The patient field is required.',
            'patient_id.exists' => 'The selected patient is invalid.',
            'doctor_id.required' => 'The doctor field is required.',
            'doctor_id.exists' => 'The selected doctor is invalid.',
        ];
    }
}
