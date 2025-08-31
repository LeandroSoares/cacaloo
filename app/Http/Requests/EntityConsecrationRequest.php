<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntityConsecrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
        ];
    }
}
