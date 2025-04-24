<?php

namespace App\Http\Requests\EmployeesDashboard;

use Illuminate\Foundation\Http\FormRequest;

class AddRequirmentsToPatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description_employee' => 'required|string|max:1000',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'description_employee.required' => 'The description_employee field is required.',
            'description_employee.string' => 'The description_employee must be a string.',
            'description_employee.max' => 'The description_employee may not be greater than 1000 characters.',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2MB.',
        ];
    }
}
