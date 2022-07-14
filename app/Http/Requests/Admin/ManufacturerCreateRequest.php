<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerCreateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->roles->contains(1);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|unique:manufacturers,name',
            'image' => 'bail|nullable|image'
        ];
    }
}