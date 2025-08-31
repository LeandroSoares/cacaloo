<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReligiousInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['nullable', 'date'],
            'start_location' => ['nullable', 'string', 'max:255'],
            'charity_house_start' => ['nullable', 'date'],
            'charity_house_end' => ['nullable', 'date'],
            'charity_house_observations' => ['nullable', 'string', 'max:1000'],
            'development_start' => ['nullable', 'date'],
            'development_end' => ['nullable', 'date'],
            'service_start' => ['nullable', 'date'],
            'umbanda_baptism' => ['nullable', 'date'],
            'cambone_experience' => ['boolean'],
            'cambone_start_date' => ['nullable', 'date'],
            'cambone_end_date' => ['nullable', 'date'],
        ];
    }
}
