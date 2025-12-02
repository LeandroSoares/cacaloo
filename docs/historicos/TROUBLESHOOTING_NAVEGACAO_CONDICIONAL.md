# Troubleshooting: Navegação Condicional

## Problemas Comuns e Soluções

### 🚨 Erro: "Undefined array key 'about'"

**Sintomas:**
- Erro 500 ao acessar qualquer página
- Stack trace aponta para `header.blade.php:X`

**Causa:**
- Código tentando acessar `$sectionsVisibility['about']['is_visible']` sem verificar se existe
- Valores padrão removidos ou mal configurados

**Solução:**
```php
// ❌ ERRADO
$aboutVisible = $sectionsVisibility['about']['is_visible'];

// ✅ CORRETO
if (empty($sectionsVisibility)) {
    $aboutVisible = true; // fallback para outras páginas
} else {
    $aboutVisible = $sectionsVisibility['about']['is_visible'] ?? false;
}
```

**Arquivos afetados:**
- `resources/views/components/layout/header.blade.php`

---

### 🚨 Links/Botões Aparecendo Quando Não Deveriam

**Sintomas:**
- Seção marcada como invisível no admin
- Links ainda aparecem no header
- Botões ainda aparecem no hero

**Diagnóstico:**
1. Verificar dados no banco:
```php
// Debug script
$sections = \App\Models\HomeSection::all();
foreach($sections as $section) {
    echo $section->section_key . " - visible: " . ($section->is_visible ? 'true' : 'false') . "\n";
}
```

2. Verificar se dados chegam ao header:
```php
// Em header.blade.php (temporariamente)
@php
dd('sectionsVisibility:', $sectionsVisibility);
@endphp
```

**Possíveis Causas:**

#### A. Valores Padrão Incorretos
```php
// ❌ PROBLEMA - sempre retorna true
$aboutVisible = $sectionsVisibility['about']['is_visible'] ?? true;

// ✅ SOLUÇÃO - verifica contexto
if (empty($sectionsVisibility)) {
    $aboutVisible = true; // outras páginas
} else {
    $aboutVisible = $sectionsVisibility['about']['is_visible'] ?? false; // home
}
```

#### B. Dados Não Sendo Passados
Verificar cadeia de passagem:
1. `HomeController` → `$homeContent`
2. `home.blade.php` → `:home-content="$homeContent"`
3. `app.blade.php` → `:sections-visibility="$homeContent"`
4. `header.blade.php` → `$sectionsVisibility`

#### C. Cache de Views
```bash
# Limpar cache de views
php artisan view:clear
php artisan config:clear
```

---

### 🚨 Página em Branco ou Erro de Sintaxe

**Sintomas:**
- Página carrega em branco
- Erro de sintaxe no Blade

**Verificações:**

#### A. Sintaxe Blade
```php
// ❌ ERRADO - faltam parênteses
@if $aboutVisible
@endif

// ✅ CORRETO
@if($aboutVisible)
@endif
```

#### B. Props Mal Definidos
```php
// ❌ ERRADO - sintaxe incorreta
<x-layout.header sections-visibility="$homeContent" />

// ✅ CORRETO
<x-layout.header :sections-visibility="$homeContent" />
```

#### C. Cache Compilado
```bash
php artisan view:clear
```

---

### 🚨 Migration Falha

**Sintomas:**
- Erro ao executar `php artisan migrate`
- Tabela `home_sections` não existe

**Soluções:**

#### A. Verificar se Tabela Existe
```sql
SHOW TABLES LIKE 'home_sections';
```

#### B. Criar Tabela Manualmente (se necessário)
```sql
CREATE TABLE home_sections (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    section_key VARCHAR(255) NOT NULL,
    title VARCHAR(255) NULL,
    title_line1 VARCHAR(255) NULL,
    title_line2 VARCHAR(255) NULL,
    subtitle VARCHAR(255) NULL,
    content TEXT NULL,
    background_image VARCHAR(255) NULL,
    background_color VARCHAR(255) NULL,
    custom_data JSON NULL,
    is_visible BOOLEAN NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (id),
    UNIQUE KEY unique_section_key (section_key)
);
```

#### C. Re-executar Migration
```bash
php artisan migrate:fresh --seed
```

---

### 🚨 Formulário Admin Não Salva

**Sintomas:**
- Formulário submetido sem erro
- Dados não aparecem na home
- Valores não persistem no banco

**Verificações:**

#### A. Validação
Verificar se há erros de validação:
```php
// No controller, adicionar debug temporário
$validated = $request->validate([...]);
dd($validated); // Ver o que está sendo validado
```

#### B. Mass Assignment
Verificar se campos estão no `$fillable`:
```php
// HomeSection.php
protected $fillable = [
    'section_key',
    'title',
    'title_line1', // ← Deve estar presente
    'title_line2', // ← Deve estar presente
    // ...
];
```

#### C. Service Method
Verificar se `updateSection` está salvando corretamente:
```php
// Em HomeContentService.php
public function updateSection(string $sectionKey, array $data): HomeSection
{
    $section = HomeSection::updateOrCreate(
        ['section_key' => $sectionKey],
        $data
    );

    $this->clearCache(); // ← Importante para limpar cache

    return $section;
}
```

---

### 🚨 Cache Não Atualiza

**Sintomas:**
- Dados alterados no admin
- Frontend ainda mostra dados antigos
- Banco tem dados corretos

**Soluções:**

#### A. Limpar Cache Específico
```php
// No service ou controller
Cache::forget('home_content');
```

#### B. Verificar TTL do Cache
```php
// Em HomeContentService.php
Cache::remember('home_content', 3600, function () { // ← 1 hora
    // Reduzir para desenvolvimento: 60 (1 minuto)
```

#### C. Desabilitar Cache Temporariamente
```php
// Para desenvolvimento
public function getHomeContent(): array
{
    return [
        'hero' => $this->getHeroSection(),
        'about' => $this->getAboutSection(),
        'events' => $this->getEventsSection(),
        'contact' => $this->getContactSection(),
    ];
    // Comentar o Cache::remember temporariamente
}
```

---

## 🛠️ Ferramentas de Debug

### 1. Script de Verificação Rápida
```php
<?php
// debug_quick.php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== HOME SECTIONS ===\n";
$sections = \App\Models\HomeSection::all();
if ($sections->isEmpty()) {
    echo "❌ Nenhuma seção encontrada\n";
} else {
    foreach($sections as $section) {
        $visible = $section->is_visible ? '✅ true' : '❌ false';
        echo "{$section->section_key}: {$visible}\n";
    }
}

echo "\n=== SERVICE OUTPUT ===\n";
$service = new \App\Services\HomeContentService();
$content = $service->getHomeContent();
foreach($content as $key => $data) {
    $visible = $data['is_visible'] ? '✅ true' : '❌ false';
    echo "{$key}: {$visible}\n";
}
```

### 2. Debug Temporário em Views
```php
// Em qualquer view Blade
@php
    error_log('DEBUG: ' . print_r($variavel, true));
@endphp
```

### 3. Logs do Laravel
```bash
# Monitorar logs em tempo real
tail -f storage/logs/laravel.log
```

---

## 📋 Checklist de Verificação

Ao implementar ou debugar:

- [ ] Migration executada com sucesso
- [ ] Campos `title_line1` e `title_line2` existem na tabela
- [ ] Model `HomeSection` tem campos no `$fillable`
- [ ] Controller valida novos campos
- [ ] Service retorna novos campos
- [ ] View da home passa dados para layout
- [ ] Layout passa dados para header
- [ ] Header aplica lógica condicional correta
- [ ] Hero recebe e usa dados de visibilidade
- [ ] Cache é limpo após alterações
- [ ] Formulário admin tem campos corretos
- [ ] Testes manuais realizados

---

## 🆘 Última Instância

Se nada funcionar:

1. **Backup do código atual**
2. **Reset da feature:**
   ```bash
   git stash
   php artisan migrate:rollback --step=1
   php artisan view:clear
   php artisan config:clear
   ```
3. **Re-implementar passo a passo:**
   - Migration
   - Model
   - Service
   - Controller
   - Views
   - Testes

4. **Verificar logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```
