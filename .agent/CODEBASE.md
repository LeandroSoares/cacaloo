# Codebase Knowledge Base - Sistema Cacaloo

> Knowledge patterns, decisions, and structures from development sessions.

---

## 📊 Data Structures

### Orixás (Orishas)

**Schema**: `database/migrations/2025_08_24_000001_create_orishas_table.php`

| Campo | Tipo | Descrição |
|:---|:---|:---|
| `id` | UUID | Identificador único |
| `name` | String | Nome do Orixá |
| `description` | Text | Descrição resumida |
| `text` | Text | Texto detalhado (qualidades, atributos) |
| `type_orisha` | String | Tipo: Universal, Cósmico |
| `throne` | String | Trono: Fé, Lei, Amor, Conhecimento, etc. |
| `oferings` | Text | Instruções de oferendas |
| `is_right` | Boolean | Atua na Direita |
| `is_left` | Boolean | Atua na Esquerda |
| `active` | Boolean | Ativo no sistema |

**Seeder**: `database/seeders/OrishaSeeder.php`
- Dados vêm de `docs/orixas/*.md`
- 14 Orixás principais: Oxalá, Oiá, Oxum, Oxumaré, Oxóssi, Obá, Xangô, Egunitá, Ogum, Iansã, Obaluaiyê, Nanã, Yemanjá, Omulú

**Model**: `app/Models/Orisha.php`
- `$fillable`: Todos os campos listados acima
- Relacionamentos: `initiatedOrishas()` (hasMany InitiatedOrisha)

---

## 🎨 UI Patterns

### Admin Layout

**Layout Principal**: `resources/views/layouts/admin.blade.php`

**Estrutura**:
```blade
<div class="flex h-full">
    <!-- Sidebar: fixed lg:static w-64 -->
    <div class="lg:static">...</div>
    
    <!-- Main Content: flex-1 (SEM lg:ml-64 redundante) -->
    <div class="flex-1 flex flex-col">
        <header>...</header>
        <main>...</main>
    </div>
</div>
```

**Problema Comum**: Evitar duplicar margem (`lg:ml-64`) quando sidebar é `lg:static`.

### Admin Orisha Views

**Show View**: `resources/views/admin/orishas/show.blade.php`

Seções:
1. **Informações Básicas**: Nome, Tipo, Trono, Status, Direita/Esquerda (com badges)
2. **Descrição**: `nl2br(e($orisha->description))`
3. **Oferendas**: `nl2br(e($orisha->oferings))`
4. **Texto Detalhado**: `whitespace-pre-wrap` para preservar formatação
5. **Estatísticas**: Usuários iniciados
6. **Lista de Iniciados**: Tabela com últimos 10

---

## 📦 Migration Patterns

### Adicionar Campo a Tabela Existente

**Exemplo**: Adicionando `throne` a `orishas`

```php
public function up(): void
{
    Schema::table('orishas', function (Blueprint $table) {
        $table->string('throne')->nullable()->after('type_orisha');
    });
}

public function down(): void
{
    Schema::table('orishas', function (Blueprint $table) {
        $table->dropColumn('throne');
    });
}
```

**Checklist**:
1. ✅ Criar migration
2. ✅ Adicionar campo ao `$fillable` do Model
3. ✅ Atualizar views (create, edit, show)
4. ✅ Atualizar seeder (se aplicável)
5. ✅ Rodar `migrate:fresh --seed` em dev

---

## 📝 Seeder Patterns

### Batch Insertion com Arrays

**Padrão**: `OrishaSeeder.php`

```php
public function run(): void
{
    $orishas = [
        [
            'name' => 'Oxalá',
            'description' => 'Trono da Fé...',
            'text' => 'Texto longo extraído do MD...',
            'type_orisha' => 'Universal',
            'throne' => 'Fé',
            'oferings' => 'Água, flores brancas...',
            'is_right' => true,
            'is_left' => false,
            'active' => true,
        ],
        // ... mais orixás
    ];

    foreach ($orishas as $orishaData) {
        Orisha::updateOrCreate(
            ['name' => $orishaData['name']],
            $orishaData
        );
    }
}
```

**Vantagens**:
- ✅ Idempotente (`updateOrCreate`)
- ✅ Fácil manutenção
- ✅ Permite rodar múltiplas vezes sem duplicar

---

## 📚 Documentation Patterns

### Estrutura Atual (v2.2)

```
docs/
├── README.md                           # Índice principal
├── CHANGELOG.md                        # Histórico de versões
├── DOCUMENTACAO_TECNICA_COMPLETA.md   # Referência técnica
├── PLANEJAMENTO_EXECUCAO_CONTROLE.md  # Gestão do projeto
├── especificacoes-features/           # Specs modulares
│   └── orixas-data-structure.md      # Estrutura de Orixás
├── implantacao/                       # Deploy guides
├── historicos/                        # Arquivos legacy
└── orixas/                            # Dados fonte (MD)
```

### Onde Documentar?

| Tipo de Mudança | Arquivo |
|:---|:---|
| Nova feature | `CHANGELOG.md` + `especificacoes-features/` |
| Schema change | `especificacoes-features/` (ex: orixas-data-structure.md) |
| Padrão técnico | Esta base de conhecimento (`.agent/CODEBASE.md`) |
| Deploy change | `docs/implantacao/` |
| Legacy reference | `docs/historicos/` |

---

## 🔧 Common Commands

### Database

```bash
# Reset e popular
php artisan migrate:fresh --seed

# Apenas rodar seeders
php artisan db:seed

# Seeder específico
php artisan db:seed --class=OrishaSeeder
```

### Cache

```bash
# Limpar todos os caches
php artisan optimize:clear

# Caches específicos
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

### Dev Server

```bash
# Laravel
php artisan serve --host=127.0.0.1 --port=8000

# Vite (assets)
npm run dev
```

---

## 🎯 Design Decisions (Session History)

### v2.2 - Orisha Data Enhancement

**Context**: Sistema tinha Orixás básicos, mas sem dados completos.

**Decisões**:
1. ✅ Adicionar campo `throne` para classificação por trono divino
2. ✅ Popular dados completos do `docs/orixas/*.md` (fonte confiável)
3. ✅ Exibir `is_right`/`is_left` com badges visuais
4. ✅ Texto detalhado preserva formatação (`whitespace-pre-wrap`)

**Trade-offs**:
- ✅ Dados ricos vs. simplicidade do schema → Optamos por campos separados
- ✅ `text` vs. `description` → Ambos, para resumo e detalhes
- ✅ Seeder manual vs. importação dinâmica → Manual (mais controle)

### Layout Fix - Admin Sidebar

**Problema**: Gap laranja entre sidebar e conteúdo.

**Causa**: Sidebar com `lg:static` + Main content com `lg:ml-64` = margem dupla.

**Solução**: Remover `lg:ml-64` do main content. Sidebar `static` já empurra o conteúdo.

---

## 🧪 Testing Patterns

### Verification Steps (Orisha Update)

1. ✅ Login como admin (`admin@cacaloo.com.br` / `cacaloo@admin123`)
2. ✅ Navegar para `/admin/orishas`
3. ✅ Visualizar detalhes de um Orixá (ex: Oxalá)
4. ✅ Verificar campos:
   - Nome, Tipo, Trono
   - Direita/Esquerda (badges)
   - Descrição
   - Oferendas
   - Texto Detalhado
5. ✅ Verificar layout (sem gap)

---

## 🔗 Related Files (Orisha Module)

| Tipo | Arquivo |
|:---|:---|
| Model | `app/Models/Orisha.php` |
| Migration | `database/migrations/2025_08_24_000001_create_orishas_table.php` |
| Seeder | `database/seeders/OrishaSeeder.php` |
| Controller | `app/Http/Controllers/Admin/OrishaController.php` |
| Views | `resources/views/admin/orishas/{index,create,edit,show}.blade.php` |
| Data Source | `docs/orixas/{oxala,ogun,etc}.md` |
| Docs | `docs/especificacoes-features/orixas-data-structure.md` |

---

## 📋 Checklist: Adding New Field to Entity

Template baseado em adicionar `throne` a Orixás:

- [ ] Create migration: `php artisan make:migration add_throne_to_orishas_table`
- [ ] Implement `up()` and `down()` methods
- [ ] Add to Model `$fillable` array
- [ ] Update `create.blade.php` (form input)
- [ ] Update `edit.blade.php` (form input with value)
- [ ] Update `show.blade.php` (display field)
- [ ] Update seeder data (if default values needed)
- [ ] Run `migrate:fresh --seed` to test
- [ ] Document in `docs/especificacoes-features/`
- [ ] Update `CHANGELOG.md`

---

## 🗂️ File Organization

### Documentation Cleanup (v2.2)

**Antes**: 15+ arquivos soltos em `docs/`

**Depois**: 6 arquivos + 7 pastas organizadas

**Movimentos**:
- ✅ Deploy guides → `docs/implantacao/`
- ✅ Legacy/specific → `docs/historicos/`
- ✅ Feature docs → `docs/especificacoes-features/`

**Benefícios**:
- Navegação mais fácil
- Menos duplicação
- Clear single source of truth

---

*Last Updated: 2026-02-05 (v2.2 - Orisha Enhancement Session)*
