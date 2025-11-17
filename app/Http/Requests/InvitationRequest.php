<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (
            Auth::user()->hasRole('admin') ||
            Auth::user()->hasRole('sysadmin')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * Permite criação de convites anônimos (sem email/whatsapp)
     * Veja: docs/especificacoes-features/convite-por-whatsapp.md
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:invitations,email|unique:users,email',
            'whatsapp' => 'nullable|string|regex:/^\(\d{2}\)\s?\d{4,5}-?\d{4}$/|unique:invitations,whatsapp',
            'expires_days' => 'nullable|integer|min:1|max:30',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já foi convidado ou já está registrado no sistema.',
            'whatsapp.regex' => 'O formato do WhatsApp deve ser: (11) 99999-9999',
            'whatsapp.unique' => 'Este WhatsApp já foi convidado.',
            'expires_days.min' => 'O prazo mínimo de expiração é de 1 dia.',
            'expires_days.max' => 'O prazo máximo de expiração é de 30 dias.',
        ];
    }
}
