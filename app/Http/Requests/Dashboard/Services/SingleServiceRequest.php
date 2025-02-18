<?php

namespace App\Http\Requests\Dashboard\Services;

use Illuminate\Foundation\Http\FormRequest;

class SingleServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string|unique:service_translations,'.$this->id.'service_id',
            'price' => 'required|numeric',
        ];
    }
}
