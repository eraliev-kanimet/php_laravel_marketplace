<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ColorCreateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->roles->contains(1);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|unique:colors,name',
            'color' => 'bail|required|string|unique:colors,color'
        ];
    }
}
