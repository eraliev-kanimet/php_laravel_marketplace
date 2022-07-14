<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerUpdateRequest extends FormRequest
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
            'name' => 'bail|required|string',
            'image' => 'bail|nullable|image',
            'remove_image' => 'nullable'
        ];
    }
}