<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriestlyFormationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theology_start' => ['nullable', 'date'],
            'theology_end' => ['nullable', 'date'],
            'priesthood_start' => ['nullable', 'date'],
            'priesthood_end' => ['nullable', 'date'],
        ];
    }
}
