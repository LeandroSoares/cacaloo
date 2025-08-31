<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrossingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['nullable', 'date'],
            'entity' => ['nullable', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
        ];
    }
}
