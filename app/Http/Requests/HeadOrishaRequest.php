<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeadOrishaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ancestor' => ['nullable', 'string', 'max:255'],
            'front' => ['nullable', 'string', 'max:255'],
            'front_together' => ['nullable', 'string', 'max:255'],
            'back' => ['nullable', 'string', 'max:255'],
            'back_together' => ['nullable', 'string', 'max:255'],
            'right' => ['nullable', 'string', 'max:255'],
            'left' => ['nullable', 'string', 'max:255'],
            'crown' => ['nullable', 'string', 'max:255'],
            'base' => ['nullable', 'string', 'max:255'],
        ];
    }
}
