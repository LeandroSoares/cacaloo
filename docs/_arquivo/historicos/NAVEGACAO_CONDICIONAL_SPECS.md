# Documentação Técnica: Sistema de Navegação Condicional

## Especificações da Implementação

### Database Schema
```sql
-- Migration: 2025_10_19_062615_add_title_lines_to_home_sections_table
ALTER TABLE home_sections 
ADD COLUMN title_line1 VARCHAR(255) NULL AFTER title,
ADD COLUMN title_line2 VARCHAR(255) NULL AFTER title_line1;
```

### Models Atualizados

#### HomeSection.php
```php
protected $fillable = [
    'section_key',
    'title',
    'title_line1',        // ← Novo campo
    'title_line2',        // ← Novo campo
    'subtitle',
    'content',
    'background_image',
    'background_color',
    'custom_data',
    'is_visible',
    'sort_order',
];
```

### Services

#### HomeContentService.php - Método getHeroSection()
```php
public function getHeroSection(): array
{
    $section = HomeSection::getByKey('hero');

    return [
        'title_line1' => $section?->title_line1 ?? 'Casa de Caridade',
        'title_line2' => $section?->title_line2 ?? 'Legião de Oxóssi e Ogum',
        'subtitle' => $section?->subtitle ?? 'Centro espírita de umbanda e candomblé',
        'background_image' => $section?->background_image,
        'background_color' => $section?->background_color ?? '#2E7D32',
        'is_visible' => $section?->is_visible ?? true,
    ];
}
```

### Controllers

#### HomeCustomizationController.php - Validação Atualizada
```php
$request->validate([
    // Hero section
    'hero_title_line1' => 'nullable|string|max:255',  // ← Novo campo
    'hero_title_line2' => 'nullable|string|max:255',  // ← Novo campo
    'hero_subtitle' => 'nullable|string|max:500',
    'hero_background_color' => 'nullable|string|max:7',
    'hero_background_image' => 'nullable|image|max:2048',
    'hero_visible' => 'boolean',
    // ... outros campos
]);
```

#### HomeCustomizationController.php - Update Hero Section
```php
$this->homeContentService->updateSection('hero', [
    'title_line1' => $request->hero_title_line1,      // ← Novo campo
    'title_line2' => $request->hero_title_line2,      // ← Novo campo
    'subtitle' => $request->hero_subtitle,
    'background_color' => $request->hero_background_color,
    'is_visible' => $request->hero_visible == '1',
]);
```

### Views

#### home.blade.php - Passagem de Dados
```php
<x-layout.app :home-content="$homeContent">
    <x-slot name="title">
        Home - Casa de Caridade Legião de Oxóssi e Ogum
    </x-slot>

    <!-- Hero Section -->
    <x-sections.hero :content="$homeContent['hero']" :sections-visibility="$homeContent" />
    
    <!-- Outras seções... -->
</x-layout.app>
```

#### app.blade.php - Layout Principal
```php
@props(['homeContent' => null])

<!DOCTYPE html>
<!-- ... head ... -->
<body>
    <!-- Header/Navegação -->
    @if($homeContent)
        <x-layout.header :sections-visibility="$homeContent" />
    @else
        <x-layout.header />
    @endif
    
    <!-- Main Content -->
    <main id="main-content">
        {{ $slot }}
    </main>
</body>
```

#### header.blade.php - Lógica Condicional
```php
@props(['sectionsVisibility' => []])

@php
// Verificar visibilidade das seções para os links de navegação
// Se sectionsVisibility está vazio, usar valores padrão (para outras páginas)
// Se sectionsVisibility tem dados, usar os valores reais do banco
if (empty($sectionsVisibility)) {
    // Outras páginas - todos os links visíveis por padrão
    $aboutVisible = true;
    $eventsVisible = true;
    $contactVisible = true;
} else {
    // Home - usar valores reais do banco
    $aboutVisible = $sectionsVisibility['about']['is_visible'] ?? false;
    $eventsVisible = $sectionsVisibility['events']['is_visible'] ?? false;
    $contactVisible = $sectionsVisibility['contact']['is_visible'] ?? false;
}
@endphp

<!-- Desktop Menu -->
<div class="hidden md:flex items-center space-x-8">
    <a href="#inicio">Início</a>
    
    @if($aboutVisible)
    <a href="#sobre">Sobre Nós</a>
    @endif
    
    @if($eventsVisible)
    <a href="#eventos">Eventos</a>
    @endif
    
    @if($contactVisible)
    <a href="#contato">Contato</a>
    @endif
</div>

<!-- Mobile Menu -->
<!-- Mesma lógica aplicada... -->
```

#### hero.blade.php - Títulos e Botões Condicionais
```php
@props(['content' => [], 'sectionsVisibility' => []])

@php
$titleLine1 = $content['title_line1'] ?? 'Casa de Caridade';
$titleLine2 = $content['title_line2'] ?? 'Legião de Oxóssi e Ogum';
$subtitle = $content['subtitle'] ?? 'Um espaço de acolhimento, caridade e conexão espiritual dedicado aos Orixás Oxóssi e Ogum';
$backgroundImage = $content['background_image'] ?? asset('images/floresta1.jpg');
$backgroundColor = $content['background_color'] ?? '#2E7D32';
$isVisible = $content['is_visible'] ?? true;

// Verificar visibilidade das seções para os botões
$aboutVisible = $sectionsVisibility['about']['is_visible'] ?? true;
$contactVisible = $sectionsVisibility['contact']['is_visible'] ?? true;
@endphp

@if($isVisible)
<section id="inicio">
    <!-- ... conteúdo ... -->
    
    <!-- Title -->
    <div>
        @if(!empty($titleLine1))
        <h1 class="text-white">{{ $titleLine1 }}</h1>
        @endif
        
        @if(!empty($titleLine2))
        <h1 class="text-gold">{{ $titleLine2 }}</h1>
        @endif
    </div>
    
    <!-- CTAs -->
    @if($aboutVisible || $contactVisible)
    <div>
        @if($aboutVisible)
        <x-ui.button href="#sobre">Saiba Mais</x-ui.button>
        @endif
        
        @if($contactVisible)
        <x-ui.button href="#contato">Entre em Contato</x-ui.button>
        @endif
    </div>
    @endif
</section>
@endif
```

### Formulário Admin

#### index.blade.php - Campos de Configuração
```html
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div>
        <label>Título - Linha 1 (Branca)</label>
        <input type="text" name="hero_title_line1" 
               value="{{ old('hero_title_line1', $homeData['hero']['title_line1'] ?? '') }}"
               placeholder="Ex: Casa de Caridade">
        <p class="text-xs text-gray-500">Deixe vazio para não exibir esta linha</p>
    </div>

    <div>
        <label>Título - Linha 2 (Dourada)</label>
        <input type="text" name="hero_title_line2" 
               value="{{ old('hero_title_line2', $homeData['hero']['title_line2'] ?? '') }}"
               placeholder="Ex: Legião de Oxóssi e Ogum">
        <p class="text-xs text-gray-500">Deixe vazio para não exibir esta linha</p>
    </div>
</div>
```

## Configuração de Cores

### Tailwind Config
```javascript
// tailwind.config.js
colors: {
    gold: {
        DEFAULT: '#D4AF37',
        light: '#F4D365',
    },
}
```

### CSS Custom Properties
```css
/* app.css */
:root {
    --gold-main: #D4AF37;
    --color-sacred-gold: #D4AF37;
}
```

## Estados de Teste

### Configuração Atual no Banco:
```
hero - visible: true
about - visible: false     ← Seção INVISÍVEL
events - visible: false    ← Seção INVISÍVEL  
contact - visible: true
```

### Resultado Esperado na Interface:
- **Header**: Links "Sobre Nós" e "Eventos" não aparecem
- **Hero**: Botão "Saiba Mais" não aparece
- **Hero**: Botão "Entre em Contato" aparece
- **Seções**: Apenas hero e contact são renderizadas

## Comandos de Debug

### Verificar Estado do Banco:
```php
// Script temporário para debug
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$sections = \App\Models\HomeSection::all();
foreach($sections as $section) {
    echo $section->section_key . " - visible: " . ($section->is_visible ? 'true' : 'false') . "\n";
}
```

### Verificar Service Output:
```php
$service = new \App\Services\HomeContentService();
$content = $service->getHomeContent();
foreach($content as $key => $sectionData) {
    echo $key . " - visible: " . ($sectionData['is_visible'] ? 'true' : 'false') . "\n";
}
```

## URLs para Teste

- **Home**: `http://localhost:8000/`
- **Admin Panel**: `http://localhost:8000/admin/home-customization`
- **Login**: `http://localhost:8000/login` (necessário para acessar admin)

## Dependências

### PHP Packages:
- Laravel 12.25.0
- PHP 8.4.11

### Frontend:
- Alpine.js (para animações)
- Tailwind CSS (para estilos)

### Database:
- MySQL/MariaDB
- Tabela: `home_sections`
