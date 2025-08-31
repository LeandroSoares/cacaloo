<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForceCrossRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'top' => ['nullable', 'string', 'max:255'],
            'bottom' => ['nullable', 'string', 'max:255'],
            'left' => ['nullable', 'string', 'max:255'],
            'right' => ['nullable', 'string', 'max:255'],
        ];
    }
}
