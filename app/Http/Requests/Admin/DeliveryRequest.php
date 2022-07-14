<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'free' => 'bail|required|boolean',
            'fitting' => 'bail|required|boolean',
            'return' => 'bail|required|numeric'
        ];
    }
}