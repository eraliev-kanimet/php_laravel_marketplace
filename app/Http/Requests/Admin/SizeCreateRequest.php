<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SizeCreateRequest extends FormRequest
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
            'name' => 'bail|required|string|unique:sizes,name',
            'description' => 'bail|required|array'
        ];
    }
}
