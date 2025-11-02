<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrishaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // O middleware AdminAccess já cuida da autorização
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $orishaId = $this->route('orisha')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:orishas,name,' . $orishaId
            ],
            'description' => 'nullable|string',
            'is_right' => 'boolean',
            'is_left' => 'boolean',
            'active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome do orixá é obrigatório.',
            'name.unique' => 'Já existe um orixá com este nome.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'description' => 'descrição',
            'is_right' => 'da direita',
            'is_left' => 'da esquerda',
            'active' => 'ativo',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_right' => $this->boolean('is_right', false),
            'is_left' => $this->boolean('is_left', false),
            'active' => $this->boolean('active', true),
        ]);
    }
}
