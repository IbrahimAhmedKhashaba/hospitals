<?php

namespace App\Http\Requests\Dashboard\Sections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $sectionId = $this->route('section');
        $rules = [
            'name' => [
                'required',
                'string',
                'max:100',
        ],
            'description' => 'required|string|max:1000',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The patient field is required.',
            'name.exists' => 'The selected patient is invalid.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The amount must be at least 0.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }
}
