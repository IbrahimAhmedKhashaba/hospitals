<?php

namespace App\Http\Requests\DoctorDashboard;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'diagnosis' => 'required|string|max:1000',
            'medicine' => 'required|string|max:1000',
            'invoice_id' => 'required|exists:invoices,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'review_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis.required' => 'The diagnosis field is required.',
            'diagnosis.string' => 'The diagnosis must be a string.',
            'diagnosis.max' => 'The diagnosis may not be greater than 1000 characters.',
            'medicine.required' => 'The medicine field is required.',
            'medicine.string' => 'The medicine must be a string.',
            'medicine.max' => 'The medicine may not be greater than 1000 characters.',
            'invoice_id.required' => 'The invoice field is required.',
            'invoice_id.exists' => 'The selected invoice is invalid.',
            'patient_id.required' => 'The patient field is required.',
            'patient_id.exists' => 'The selected patient is invalid.',
            'doctor_id.required' => 'The doctor field is required.',
            'doctor_id.exists' => 'The selected doctor is invalid.',
            'review_date.required' => 'The review date field is required.',
            'review_date.date_format' => 'The review date must be in the format Y-m-d H:i:s.',
        ];
    }
}
