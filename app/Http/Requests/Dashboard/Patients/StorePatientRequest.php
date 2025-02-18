<?php

namespace App\Http\Requests\Dashboard\Patients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $patientId = $this->route('patient');
        \Log::info($patientId);

        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('patients')->ignore($patientId, 'id'),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('patients')->ignore($patientId, 'id'),
            ],
            'name' => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'date_birth' => 'required|date',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'address' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.sometimes' => trans('validation.sometimes'),
            'Phone.required' => trans('validation.required'),
            'Phone.unique' => trans('validation.unique'),
            'Phone.numeric' => trans('validation.numeric'),
            'Date_Birth.required' => trans('validation.required'),
            'Date_Birth.date' => trans('validation.date'),
            'Gender.required' => trans('validation.required'),
            'Gender.integer' => trans('validation.integer'),
            'Blood_Group.required' => trans('validation.required'),
        ];
    }
}
