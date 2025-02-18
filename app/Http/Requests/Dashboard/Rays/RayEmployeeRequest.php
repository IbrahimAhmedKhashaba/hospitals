<?php

namespace App\Http\Requests\Dashboard\Rays;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RayEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $Id = $this->route('ray');

        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('ray_employees')->ignore($Id, 'id'),
            ],
            'name' => 'required|string|max:255',
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
            'name.required' => 'The name field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2MB.',
        ];
    }
}
