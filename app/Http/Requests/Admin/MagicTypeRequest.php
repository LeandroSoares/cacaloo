<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MagicTypeRequest extends FormRequest
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
        $magicTypeId = $this->route('magic_type')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:magic_types,name,' . $magicTypeId
            ],
            'description' => 'nullable|string',
            'active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome do tipo de magia é obrigatório.',
            'name.unique' => 'Já existe um tipo de magia com este nome.',
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
            'active' => 'ativo',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'active' => $this->boolean('active', true),
        ]);
    }
}
