<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:20'],
            'rg' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'home_phone' => ['nullable', 'string', 'max:20'],
            'mobile_phone' => ['nullable', 'string', 'max:20'],
            'work_phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
        ];
    }
}
