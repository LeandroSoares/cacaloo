# Convite por WhatsApp - Funcionalidade Futura

## 📋 Descrição

Permitir que convites sejam enviados **apenas por WhatsApp**, sem necessidade de e-mail, utilizando o número de telefone como identificador único.

## 🎯 Objetivo

Atualmente, o sistema exige e-mail obrigatório e WhatsApp opcional. A funcionalidade futura deve permitir:
- Convite **somente por e-mail** (comportamento atual)
- Convite **somente por WhatsApp** (novo)
- Convite com **ambos** (e-mail + WhatsApp)

## 🔧 Alterações Necessárias

### 1. **Migration - Tabela `invitations`**
```php
// Remover unique constraint do email
// Adicionar unique constraint no whatsapp (já existe nullable)
// Adicionar constraint: pelo menos um dos dois deve estar preenchido

Schema::table('invitations', function (Blueprint $table) {
    $table->string('email')->nullable()->change(); // Tornar opcional
    $table->unique('whatsapp'); // Adicionar unique constraint
});

// Adicionar check constraint (MySQL 8.0.16+)
DB::statement('ALTER TABLE invitations ADD CONSTRAINT check_email_or_whatsapp 
    CHECK (email IS NOT NULL OR whatsapp IS NOT NULL)');
```

### 2. **Model - `Invitation.php`**
```php
// Adicionar validação no model
protected static function boot()
{
    parent::boot();
    
    static::saving(function ($invitation) {
        if (empty($invitation->email) && empty($invitation->whatsapp)) {
            throw new \InvalidArgumentException(
                'Pelo menos um contato (e-mail ou WhatsApp) deve ser fornecido.'
            );
        }
    });
}

// Método helper
public function getPrimaryContact(): string
{
    return $this->email ?? $this->whatsapp ?? '-';
}

public function getContactType(): string
{
    if ($this->email && $this->whatsapp) {
        return 'both';
    }
    return $this->email ? 'email' : 'whatsapp';
}
```

### 3. **Form Request - `InvitationRequest.php`**
```php
public function rules(): array
{
    return [
        'email' => [
            'nullable',
            'email',
            'unique:invitations,email',
            'unique:users,email',
            // Se whatsapp não for fornecido, email é obrigatório
            Rule::requiredIf(function () {
                return empty($this->whatsapp);
            }),
        ],
        'whatsapp' => [
            'nullable',
            'string',
            'regex:/^\(\d{2}\)\s?\d{4,5}-?\d{4}$/',
            'unique:invitations,whatsapp',
            // Se email não for fornecido, whatsapp é obrigatório
            Rule::requiredIf(function () {
                return empty($this->email);
            }),
        ],
        'expires_days' => 'nullable|integer|min:1|max:30',
    ];
}

public function messages(): array
{
    return [
        'email.required_if' => 'O e-mail é obrigatório quando o WhatsApp não é fornecido.',
        'email.unique' => 'Este email já foi convidado ou já está registrado no sistema.',
        'whatsapp.required_if' => 'O WhatsApp é obrigatório quando o e-mail não é fornecido.',
        'whatsapp.regex' => 'O formato do WhatsApp deve ser: (11) 99999-9999',
        'whatsapp.unique' => 'Este WhatsApp já foi convidado.',
        'expires_days.min' => 'O prazo mínimo de expiração é de 1 dia.',
        'expires_days.max' => 'O prazo máximo de expiração é de 30 dias.',
    ];
}

// Validação customizada adicional
public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if (empty($this->email) && empty($this->whatsapp)) {
            $validator->errors()->add(
                'contact',
                'É necessário fornecer pelo menos um meio de contato (e-mail ou WhatsApp).'
            );
        }
    });
}
```

### 4. **Service - `InvitationService.php`**
```php
/**
 * Cria um novo convite
 * 
 * @param string|null $email E-mail do convidado (opcional se whatsapp fornecido)
 * @param int $invitedBy ID do usuário que está convidando
 * @param int $expirationDays Dias até expiração
 * @param string|null $whatsapp WhatsApp do convidado (opcional se email fornecido)
 * @throws \InvalidArgumentException Se nem email nem whatsapp forem fornecidos
 */
public function create(
    ?string $email, 
    int $invitedBy, 
    int $expirationDays = 7, 
    ?string $whatsapp = null
): Invitation {
    if (empty($email) && empty($whatsapp)) {
        throw new \InvalidArgumentException(
            'É necessário fornecer pelo menos um meio de contato.'
        );
    }

    $invitation = Invitation::create([
        'email' => $email,
        'whatsapp' => $whatsapp,
        'token' => Invitation::generateToken(),
        'invited_by' => $invitedBy,
        'status' => Invitation::STATUS_PENDING,
        'expires_at' => now()->addDays($expirationDays),
    ]);

    // Enviar por e-mail se fornecido
    if ($email) {
        $this->sendInvitationEmail($invitation);
    }
    
    // Enviar por WhatsApp se fornecido
    if ($whatsapp) {
        $this->sendInvitationWhatsApp($invitation);
    }

    return $invitation;
}

/**
 * Envia convite via WhatsApp
 */
protected function sendInvitationWhatsApp(Invitation $invitation): void
{
    // TODO: Implementar integração com API do WhatsApp
    // Opções:
    // - Twilio WhatsApp API
    // - WhatsApp Business API
    // - Evolution API (solução local)
    
    $message = "Você recebeu um convite para se juntar ao {$appName}! "
             . "Acesse o link para se registrar: {$invitationUrl}";
    
    // WhatsAppService::send($invitation->whatsapp, $message);
}
```

### 5. **View - `create.blade.php`**
```blade
<div x-data="{ contactMethod: 'email' }" class="mb-4">
    <x-input-label :value="__('Método de Contato')" />
    
    <div class="flex space-x-4 mt-2">
        <label class="inline-flex items-center">
            <input type="radio" x-model="contactMethod" value="email" class="form-radio">
            <span class="ml-2">E-mail</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" x-model="contactMethod" value="whatsapp" class="form-radio">
            <span class="ml-2">WhatsApp</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" x-model="contactMethod" value="both" class="form-radio">
            <span class="ml-2">Ambos</span>
        </label>
    </div>
</div>

<div x-show="contactMethod === 'email' || contactMethod === 'both'" class="mb-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" 
        type="email" name="email" :value="old('email')" 
        ::required="contactMethod !== 'whatsapp'" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div x-show="contactMethod === 'whatsapp' || contactMethod === 'both'" class="mb-4">
    <x-input-label for="whatsapp" :value="__('WhatsApp')" />
    <x-text-input id="whatsapp" class="block mt-1 w-full" 
        type="text" name="whatsapp" :value="old('whatsapp')" 
        placeholder="(11) 99999-9999"
        ::required="contactMethod !== 'email'" />
    <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
</div>
```

### 6. **View - `index.blade.php`**
```blade
<!-- Substituir colunas separadas por uma única coluna de contato -->
<th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
    Contato
</th>

<!-- No corpo da tabela -->
<td class="py-4 px-6 text-sm text-gray-900">
    @if($invitation->email && $invitation->whatsapp)
        <div class="flex flex-col">
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                {{ $invitation->email }}
            </span>
            <span class="flex items-center mt-1">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                {{ $invitation->whatsapp }}
            </span>
        </div>
    @elseif($invitation->email)
        <span class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
            </svg>
            {{ $invitation->email }}
        </span>
    @else
        <span class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            {{ $invitation->whatsapp }}
        </span>
    @endif
</td>
```

### 7. **Testes**
```php
// tests/Feature/InvitationFunctionalityTest.php

/** @test */
public function admin_can_create_invitation_with_only_email(): void
{
    // Já existe - comportamento atual
}

/** @test */
public function admin_can_create_invitation_with_only_whatsapp(): void
{
    Mail::fake();
    
    $this->actingAs($this->admin);
    
    $response = $this->post(route('admin.invitations.store'), [
        'whatsapp' => '(11) 99999-9999',
        'expires_days' => 7
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('invitations', [
        'whatsapp' => '(11) 99999-9999',
        'email' => null,
        'invited_by' => $this->admin->id,
    ]);
    
    // Email não deve ser enviado
    Mail::assertNothingSent();
}

/** @test */
public function admin_can_create_invitation_with_both_contacts(): void
{
    Mail::fake();
    
    $this->actingAs($this->admin);
    
    $response = $this->post(route('admin.invitations.store'), [
        'email' => 'teste@example.com',
        'whatsapp' => '(11) 99999-9999',
        'expires_days' => 7
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('invitations', [
        'email' => 'teste@example.com',
        'whatsapp' => '(11) 99999-9999',
    ]);
}

/** @test */
public function cannot_create_invitation_without_any_contact(): void
{
    $this->actingAs($this->admin);
    
    $response = $this->post(route('admin.invitations.store'), [
        'expires_days' => 7
    ]);
    
    $response->assertSessionHasErrors(['contact']);
}

/** @test */
public function whatsapp_must_be_unique(): void
{
    Invitation::factory()->create([
        'whatsapp' => '(11) 99999-9999'
    ]);
    
    $this->actingAs($this->admin);
    
    $response = $this->post(route('admin.invitations.store'), [
        'whatsapp' => '(11) 99999-9999',
        'expires_days' => 7
    ]);
    
    $response->assertSessionHasErrors(['whatsapp']);
}
```

## 📦 Integrações de WhatsApp

### Opções de API:

1. **Twilio WhatsApp API** (Pago, mais confiável)
   - Documentação: https://www.twilio.com/docs/whatsapp
   - Precisa de número aprovado pelo WhatsApp Business

2. **WhatsApp Business API** (Oficial, complexo)
   - Requer aprovação e infraestrutura dedicada
   - Documentação: https://developers.facebook.com/docs/whatsapp

3. **Evolution API** (Open Source, hospedagem própria)
   - GitHub: https://github.com/EvolutionAPI/evolution-api
   - Baseado em Baileys (biblioteca não oficial)
   - Mais simples de implementar

4. **WAPI.js / Venom-bot** (Open Source, arriscado)
   - Pode resultar em ban da conta
   - Não recomendado para produção

### Recomendação:
Usar **Evolution API** para início + migrar para **Twilio** em produção.

## 🔒 Considerações de Segurança

1. **Validação de Telefone**: Implementar validação de número real (não apenas formato)
2. **Rate Limiting**: Limitar envios por IP/usuário para evitar spam
3. **Logs**: Registrar todas as tentativas de envio
4. **Opt-out**: Permitir que usuários bloqueiem convites por WhatsApp

## 📅 Prioridade

**Média** - Funcionalidade desejável mas não crítica para MVP.

## ✅ Checklist de Implementação

- [ ] Criar migration para tornar email nullable e adicionar constraints
- [ ] Atualizar Model com validações
- [ ] Atualizar InvitationRequest com validação condicional
- [ ] Atualizar InvitationService para suportar ambos os métodos
- [ ] Implementar sendInvitationWhatsApp() no Service
- [ ] Atualizar view create.blade.php com seletor de método
- [ ] Atualizar view index.blade.php com coluna unificada
- [ ] Criar testes para todos os cenários
- [ ] Escolher e integrar API de WhatsApp
- [ ] Documentar processo de configuração da API
- [ ] Testar em ambiente de desenvolvimento
- [ ] Testar em ambiente de produção

---

**Data de criação**: 17/11/2025  
**Status**: 📝 Planejado  
**Responsável**: A definir
