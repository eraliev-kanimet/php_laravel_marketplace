<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SizeUpdateRequest extends FormRequest
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
            'name' => 'bail|required|string',
            'description' => 'bail|required|array'
        ];
    }
}
