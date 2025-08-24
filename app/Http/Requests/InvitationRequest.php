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
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:invitations,email|unique:users,email',
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
            'email.unique' => 'Este email já foi convidado ou já está registrado no sistema.',
            'expires_days.min' => 'O prazo mínimo de expiração é de 1 dia.',
            'expires_days.max' => 'O prazo máximo de expiração é de 30 dias.',
        ];
    }
}
