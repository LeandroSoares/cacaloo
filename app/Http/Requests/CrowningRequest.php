<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrowningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'guide_name' => ['nullable', 'string', 'max:255'],
            'priest_name' => ['nullable', 'string', 'max:255'],
            'temple_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
