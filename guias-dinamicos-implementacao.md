# Sistema Dinâmico de Guias de Trabalho - Plano de Implementação

**Branch:** `feature/dynamic-work-guides`  
**Data de Início:** 2026-02-10  
**Estimativa:** 3-5 dias  
**Status:** 🟡 Planejamento

---

## 📌 Visão Geral

Refatorar o sistema de guias de trabalho de uma estrutura hardcoded (13 campos fixos) para uma arquitetura dinâmica que permite aos administradores gerenciar categorias via painel admin.

### Problema Atual

- 13 categorias de guias hardcoded na tabela `work_guides`
- Adicionar novas categorias requer migration + código + deploy
- Sem interface administrativa para gestão

### Solução Proposta

**Arquitetura Normalizada:**
```
work_guide_categories (MASTER)
├── id, name, slug, icon, display_order, is_active
└── hasMany → work_guide_user_values

work_guide_user_values (DADOS)
├── id, user_id, category_id, value
└── belongsTo → users, work_guide_categories
```

---

## 🎯 Objetivos de Sucesso

- [x] **Escalabilidade:** Adicionar categorias sem código
- [x] **Usabilidade:** Interface admin intuitiva para gestão
- [x] **Compatibilidade:** Migração sem perda de dados (100%)
- [x] **Performance:** Queries otimizadas com indexes
- [x] **Manutenibilidade:** Código limpo seguindo padrões Laravel

---

## 🏗️ Arquitetura Técnica

### Nova Estrutura de Banco de Dados

#### Tabela: `work_guide_categories`

| Campo | Tipo | Null | Default | Descrição |
|-------|------|------|---------|-----------|
| id | bigint unsigned | NO | AUTO | PK |
| name | varchar(255) | NO | - | Nome da categoria (ex: "Caboclo") |
| slug | varchar(255) | NO | - | Slug único (ex: "caboclo") |
| icon | varchar(50) | YES | NULL | Emoji/ícone (ex: "🌿") |
| display_order | int | NO | 0 | Ordem de exibição |
| is_active | boolean | NO | true | Status ativo/inativo |
| created_at | timestamp | YES | NULL | - |
| updated_at | timestamp | YES | NULL | - |

**Indexes:**
- UNIQUE: `slug`
- INDEX: `is_active`, `display_order`

#### Tabela: `work_guide_user_values`

| Campo | Tipo | Null | Default | Descrição |
|-------|------|------|---------|-----------|
| id | bigint unsigned | NO | AUTO | PK |
| user_id | bigint unsigned | NO | - | FK → users.id |
| category_id | bigint unsigned | NO | - | FK → work_guide_categories.id |
| value | varchar(255) | YES | NULL | Valor do guia (nome da entidade) |
| created_at | timestamp | YES | NULL | - |
| updated_at | timestamp | YES | NULL | - |

**Indexes:**
- UNIQUE: `(user_id, category_id)` - Previne duplicatas
- INDEX: `user_id`, `category_id`
- FOREIGN KEY: `user_id` → CASCADE, `category_id` → CASCADE

---

## 📦 Mudanças Propostas

### Componente 1: Backend (Models + Migrations)

#### [NEW] `app/Models/WorkGuideCategory.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkGuideCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // Relacionamentos
    public function userValues(): HasMany
    {
        return $this->hasMany(WorkGuideUserValue::class, 'category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
```

#### [NEW] `app/Models/WorkGuideUserValue.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkGuideUserValue extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'value',
    ];

    // Relacionamentos
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkGuideCategory::class, 'category_id');
    }
}
```

#### [MODIFY] `app/Models/User.php`

```php
// Adicionar novo relacionamento
public function workGuideValues(): HasMany
{
    return $this->hasMany(WorkGuideUserValue::class);
}

// Manter temporariamente para compatibilidade
public function workGuide(): HasOne
{
    return $this->hasOne(WorkGuide::class);
}
```

---

### Componente 2: Admin CRUD

#### [NEW] `app/Http/Controllers/Admin/WorkGuideCategoryController.php`

Controller completo com CRUD seguindo padrão do `ContentController`.

**Principais métodos:**
- `index()` - Listagem paginada com busca
- `create()` - Formulário de criação
- `store()` - Validação + persistência
- `edit()` - Formulário de edição
- `update()` - Validação + atualização
- `destroy()` - Exclusão (cascade automático)

**Validações:**
```php
'name' => 'required|string|max:255',
'slug' => 'required|string|max:255|unique:work_guide_categories,slug',
'icon' => 'nullable|string|max:50',
'display_order' => 'required|integer|min:0',
'is_active' => 'boolean',
```

#### [NEW] Views Admin

**Estrutura:**
```
resources/views/admin/work-guide-categories/
├── index.blade.php   (Tabela + Busca + Ações)
├── create.blade.php  (Formulário criação)
└── edit.blade.php    (Formulário edição)
```

**Features da listagem:**
- Busca por nome/slug
- Filtro ativo/inativo
- Reordenação drag-and-drop (opcional)
- Ações: Editar, Excluir, Toggle Active

---

### Componente 3: Frontend (Livewire Component)

#### [MODIFY] `app/Livewire/WorkGuideForm.php`

**Mudanças principais:**

```php
// Antes: 13 propriedades hardcoded
public $caboclo = null;
public $cabocla = null;
// ... etc

// Depois: Propriedade dinâmica
public $userValues = []; // ['category_id' => 'value']

public function mount(User $user)
{
    $this->user = $user;
    
    // Carregar valores existentes
    $this->userValues = $user->workGuideValues()
        ->pluck('value', 'category_id')
        ->toArray();
}

public function save()
{
    $categories = WorkGuideCategory::active()->get();
    
    foreach ($categories as $category) {
        $value = $this->userValues[$category->id] ?? null;
        
        $this->user->workGuideValues()->updateOrCreate(
            ['category_id' => $category->id],
            ['value' => $value]
        );
    }
    
    session()->flash('message', 'Guias de trabalho salvos com sucesso.');
}
```

#### [MODIFY] `resources/views/livewire/work-guide-form.blade.php`

```blade
<x-form-card title="Guias de Trabalho" icon="🕯️">
    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach(\App\Models\WorkGuideCategory::active()->ordered()->get() as $category)
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        @if($category->icon) {{ $category->icon }} @endif
                        {{ $category->name }}
                    </label>
                    <input 
                        type="text" 
                        wire:model="userValues.{{ $category->id }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                </div>
            @endforeach
        </div>
        
        <div class="flex justify-end mt-6">
            <x-button type="submit">Salvar</x-button>
        </div>
    </form>
</x-form-card>
```

---

### Componente 4: Migração de Dados

#### [NEW] `database/seeders/WorkGuideCategorySeeder.php`

Inserir as 13 categorias atuais:

```php
$categories = [
    ['name' => 'Caboclo', 'slug' => 'caboclo', 'icon' => '🌿', 'display_order' => 1],
    ['name' => 'Cabocla', 'slug' => 'cabocla', 'icon' => '🌸', 'display_order' => 2],
    ['name' => 'Ogum', 'slug' => 'ogum', 'icon' => '⚔️', 'display_order' => 3],
    ['name' => 'Xangô', 'slug' => 'xango', 'icon' => '⚡', 'display_order' => 4],
    ['name' => 'Baiano', 'slug' => 'baiano', 'icon' => '🎩', 'display_order' => 5],
    ['name' => 'Baiana', 'slug' => 'baiana', 'icon' => '💃', 'display_order' => 6],
    ['name' => 'Preto Velho', 'slug' => 'preto_velho', 'icon' => '👴', 'display_order' => 7],
    ['name' => 'Preta Velha', 'slug' => 'preta_velha', 'icon' => '👵', 'display_order' => 8],
    ['name' => 'Marinheiro', 'slug' => 'marinheiro', 'icon' => '⚓', 'display_order' => 9],
    ['name' => 'Erê', 'slug' => 'ere', 'icon' => '🧒', 'display_order' => 10],
    ['name' => 'Exu', 'slug' => 'exu', 'icon' => '🔱', 'display_order' => 11],
    ['name' => 'Pombagira', 'slug' => 'pombagira', 'icon' => '💋', 'display_order' => 12],
    ['name' => 'Exu Mirim', 'slug' => 'exu_mirim', 'icon' => '👦', 'display_order' => 13],
];
```

#### [NEW] Migration de Dados

```php
// Migrar dados existentes de work_guides → work_guide_user_values
$workGuides = DB::table('work_guides')->get();

foreach ($workGuides as $workGuide) {
    $categoryMap = [
        'caboclo' => 1,
        'cabocla' => 2,
        // ... mapping
    ];
    
    foreach ($categoryMap as $field => $categoryId) {
        if (!empty($workGuide->$field)) {
            DB::table('work_guide_user_values')->insert([
                'user_id' => $workGuide->user_id,
                'category_id' => $categoryId,
                'value' => $workGuide->$field,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
```

---

## 🔄 Fluxo de Implementação

### Fase 1: Preparação (30min)
1. Criar branch `feature/dynamic-work-guides`
2. Documentar estrutura atual
3. Backup de dados de desenvolvimento

### Fase 2: Backend (2-3h)
1. Criar migrations (categories + user_values)
2. Criar models (WorkGuideCategory, WorkGuideUserValue)
3. Atualizar User model
4. Rodar migrations
5. Criar seeder de categorias

### Fase 3: Admin CRUD (3-4h)
1. Criar WorkGuideCategoryController
2. Criar views admin (index, create, edit)
3. Registrar rotas
4. Adicionar link no menu admin
5. Testar CRUD completo

### Fase 4: Frontend (2-3h)
1. Refatorar WorkGuideForm.php
2. Atualizar work-guide-form.blade.php
3. Testar formulário dinâmico

### Fase 5: Migração (1-2h)
1. Criar migration de dados
2. Validar integridade
3. (Opcional) Deprecar tabela antiga

### Fase 6: Testes e Validação (2-3h)
1. Testes unitários
2. Testes funcionais
3. Validação manual completa
4. Code review

---

## ✅ Critérios de Aceitação

- [ ] Admin pode criar/editar/excluir categorias de guias
- [ ] Formulário de usuário renderiza categorias dinamicamente
- [ ] 100% dos dados atuais migrados sem perda
- [ ] Performance mantida ou melhorada (queries otimizadas)
- [ ] Código segue padrões Laravel e do projeto
- [ ] Testes cobrem funcionalidades críticas
- [ ] Documentação atualizada

---

## 🛡️ Plano de Rollback

**Se houver problemas críticos:**

1. **Código:** `git checkout main/develop`
2. **Banco de Dados:** 
   - Restaurar backup
   - OU manter `work_guides` antiga ativa
3. **Tempo máximo de rollback:** < 5 minutos

---

## 📚 Referências

- [WorkGuide Model Atual](file:///c:/Users/leand/projects/cacaloo/app/Models/WorkGuide.php)
- [ContentController (Padrão CRUD)](file:///c:/Users/leand/projects/cacaloo/app/Http/Controllers/Admin/ContentController.php)
- [Análise Técnica Completa](file:///C:/Users/leand/.gemini/antigravity/brain/1c567fef-e680-45c9-9428-5a7708873381/analise-feedback-guias-trabalho.md)

---

**Próximo passo:** Aguardando aprovação para iniciar implementação.
