<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DailyMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole(['admin', 'sysadmin']);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'author' => 'nullable|string|max:255',
            'active' => 'boolean',
            'valid_from' => 'nullable|date|before_or_equal:valid_until',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'notes' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'message.required' => 'A mensagem é obrigatória.',
            'message.max' => 'A mensagem não pode ter mais de 1000 caracteres.',
            'author.max' => 'O nome do autor não pode ter mais de 255 caracteres.',
            'valid_from.date' => 'A data de início deve ser uma data válida.',
            'valid_from.before_or_equal' => 'A data de início deve ser anterior ou igual à data final.',
            'valid_until.date' => 'A data final deve ser uma data válida.',
            'valid_until.after_or_equal' => 'A data final deve ser posterior ou igual à data de início.',
            'notes.max' => 'As observações não podem ter mais de 500 caracteres.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'título',
            'message' => 'mensagem',
            'author' => 'autor',
            'active' => 'ativo',
            'valid_from' => 'válida a partir de',
            'valid_until' => 'válida até',
            'notes' => 'observações',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'active' => $this->boolean('active'),
        ]);
    }
}
