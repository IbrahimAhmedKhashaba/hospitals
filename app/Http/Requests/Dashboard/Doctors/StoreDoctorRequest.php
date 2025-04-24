<?php
namespace App\Http\Requests\Dashboard\Doctors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $doctorId = $this->route('doctor');

        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('doctors')->ignore($doctorId, 'id'), // id should match your table's primary key
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('doctors')->ignore($doctorId, 'id'), // same here
            ],
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|max:255',
            'appointments' => 'nullable|array',
            'appointments.*' => 'exists:appointments,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.unique' => 'The phone number has already been taken.',
            'section_id.required' => 'The section field is required.',
            'section_id.exists' => 'The selected section is invalid.',
            'name.required' => 'The name field is required.',
            'appointments.*.exists' => 'One or more selected appointments are invalid.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2MB.',
        ];
    }
}
