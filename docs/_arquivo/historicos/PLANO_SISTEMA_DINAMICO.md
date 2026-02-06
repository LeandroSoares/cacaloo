# 📋 Plano de Implementação - Sistema de Conteúdo Dinâmico
**Casa de Caridade Legião de Oxóssi e Ogum**

---

## 🎯 **OBJETIVO**
Transformar a homepage em um sistema totalmente dinâmico e administrável, permitindo que administradores editem textos, controlem visibilidade de seções e gerenciem eventos através de interface web.

---

## 🗄️ **ESTRUTURA DE BANCO DE DADOS**

### **1. Tabela `site_home_sections`**
Para gerenciar seções da homepage:
```sql
CREATE TABLE site_home_sections (
    id CHAR(36) PRIMARY KEY,
    section_key VARCHAR(50) UNIQUE NOT NULL COMMENT 'hero, about, contact, etc.',
    title VARCHAR(255) NOT NULL,
    subtitle TEXT NULL,
    content LONGTEXT NULL,
    image_path VARCHAR(255) NULL,
    background_image VARCHAR(255) NULL,
    is_visible BOOLEAN DEFAULT TRUE,
    display_order INTEGER DEFAULT 0,
    meta_data JSON NULL COMMENT 'Dados extras específicos da seção',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_section_key (section_key),
    INDEX idx_visible_order (is_visible, display_order)
);
```

### **2. Tabela `site_home_cards`**
Para cards da seção "Sobre":
```sql
CREATE TABLE site_home_cards (
    id CHAR(36) PRIMARY KEY,
    section_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    icon_class VARCHAR(100) NULL COMMENT 'Classes CSS para ícones',
    icon_svg LONGTEXT NULL COMMENT 'SVG personalizado',
    is_visible BOOLEAN DEFAULT TRUE,
    display_order INTEGER DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (section_id) REFERENCES site_home_sections(id) ON DELETE CASCADE,
    INDEX idx_section_visible (section_id, is_visible),
    INDEX idx_display_order (display_order)
);
```

### **3. Tabela `events`**
Para eventos/giras:
```sql
CREATE TABLE events (
    id CHAR(36) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    event_date DATE NULL COMMENT 'Para eventos específicos',
    event_time TIME NOT NULL,
    day_of_week ENUM('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NULL,
    recurrence_type ENUM('unique','weekly','monthly','yearly') DEFAULT 'unique',
    is_active BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    background_color VARCHAR(7) DEFAULT '#2E7D32' COMMENT 'Cor do card',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_active_featured (is_active, is_featured),
    INDEX idx_event_date (event_date),
    INDEX idx_day_of_week (day_of_week)
);
```

### **4. Tabela `site_settings`**
Para configurações gerais:
```sql
CREATE TABLE site_settings (
    id CHAR(36) PRIMARY KEY,
    key VARCHAR(100) UNIQUE NOT NULL,
    value LONGTEXT NOT NULL,
    type ENUM('text','textarea','boolean','json','image','color') DEFAULT 'text',
    description TEXT NULL,
    group_name VARCHAR(50) DEFAULT 'general' COMMENT 'contact, social, seo, etc.',
    is_editable BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_key (key),
    INDEX idx_group (group_name)
);
```

---

## 🏗️ **ARQUITETURA LARAVEL**

### **Models e Relacionamentos:**

#### **HomeSection.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class HomeSection extends Model
{
    use HasUuids;

    protected $table = 'site_home_sections';

    protected $fillable = [
        'section_key', 'title', 'subtitle', 'content', 
        'image_path', 'background_image', 'is_visible', 
        'display_order', 'meta_data'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'meta_data' => 'array',
        'display_order' => 'integer'
    ];

    // Relacionamentos
    public function cards(): HasMany
    {
        return $this->hasMany(HomeSectionCard::class, 'section_id')
                    ->where('is_visible', true)
                    ->orderBy('display_order');
    }

    // Scopes
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function scopeByKey(Builder $query, string $key): Builder
    {
        return $query->where('section_key', $key);
    }
}
```

#### **HomeSectionCard.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class HomeSectionCard extends Model
{
    use HasUuids;

    protected $table = 'site_home_cards';

    protected $fillable = [
        'section_id', 'title', 'content', 'icon_class', 
        'icon_svg', 'is_visible', 'display_order'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'display_order' => 'integer'
    ];

    // Relacionamentos
    public function section(): BelongsTo
    {
        return $this->belongsTo(HomeSection::class, 'section_id');
    }

    // Scopes
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }
}
```

#### **Event.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Event extends Model
{
    use HasUuids;

    protected $fillable = [
        'title', 'description', 'event_date', 'event_time',
        'day_of_week', 'recurrence_type', 'is_active', 
        'is_featured', 'background_color'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming(Builder $query, int $limit = 10): Builder
    {
        return $query->active()
                    ->where(function($q) {
                        $q->whereNotNull('event_date')
                          ->where('event_date', '>=', now()->toDateString())
                          ->orWhereNotNull('day_of_week');
                    })
                    ->orderBy('event_date')
                    ->limit($limit);
    }

    // Accessors
    public function getFormattedDateAttribute(): string
    {
        if ($this->event_date) {
            return $this->event_date->format('d/m');
        }
        
        return $this->getNextOccurrenceDate();
    }

    // Métodos auxiliares
    private function getNextOccurrenceDate(): string
    {
        if (!$this->day_of_week) return '';
        
        $daysOfWeek = [
            'monday' => 1, 'tuesday' => 2, 'wednesday' => 3,
            'thursday' => 4, 'friday' => 5, 'saturday' => 6, 'sunday' => 0
        ];
        
        $targetDay = $daysOfWeek[$this->day_of_week];
        $today = Carbon::today();
        $nextOccurrence = $today->next($targetDay);
        
        return $nextOccurrence->format('d/m');
    }
}
```

#### **SiteSetting.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'key', 'value', 'type', 'description', 
        'group_name', 'is_editable'
    ];

    protected $casts = [
        'is_editable' => 'boolean'
    ];

    // Métodos estáticos para facilitar uso
    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function() use ($key, $default) {
            $setting = static::where('key', $key)->first();
            
            if (!$setting) return $default;
            
            return match($setting->type) {
                'boolean' => (bool) $setting->value,
                'json' => json_decode($setting->value, true),
                default => $setting->value
            };
        });
    }

    public static function set(string $key, $value): void
    {
        $setting = static::firstOrNew(['key' => $key]);
        $setting->value = is_array($value) ? json_encode($value) : $value;
        $setting->save();
        
        Cache::forget("setting.{$key}");
    }

    public static function getAllForFrontend(): array
    {
        return Cache::remember('settings.frontend', 3600, function() {
            return static::all()
                        ->pluck('value', 'key')
                        ->toArray();
        });
    }
}
```

---

## 🔧 **SERVICES PARA LÓGICA DE NEGÓCIO**

### **HomeContentService.php**
```php
<?php

namespace App\Services;

use App\Models\HomeSection;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class HomeContentService
{
    public function getHomePageData(): array
    {
        return Cache::remember('homepage.data', 1800, function() {
            return [
                'sections' => $this->getVisibleSections(),
                'settings' => SiteSetting::getAllForFrontend()
            ];
        });
    }

    public function getVisibleSections(): Collection
    {
        return HomeSection::visible()
                          ->ordered()
                          ->with(['cards' => function($query) {
                              $query->visible()->ordered();
                          }])
                          ->get();
    }

    public function getSectionByKey(string $key): ?HomeSection
    {
        return Cache::remember("section.{$key}", 1800, function() use ($key) {
            return HomeSection::byKey($key)
                             ->visible()
                             ->with(['cards' => function($query) {
                                 $query->visible()->ordered();
                             }])
                             ->first();
        });
    }

    public function getSectionCards(string $sectionKey): Collection
    {
        $section = $this->getSectionByKey($sectionKey);
        return $section ? $section->cards : collect();
    }

    public function clearCache(): void
    {
        Cache::forget('homepage.data');
        Cache::forget('settings.frontend');
        
        // Limpar cache de seções individuais
        $sections = HomeSection::pluck('section_key');
        foreach ($sections as $key) {
            Cache::forget("section.{$key}");
        }
    }
}
```

### **EventService.php**
```php
<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class EventService
{
    public function getUpcomingEvents(int $limit = 3): Collection
    {
        return Cache::remember("events.upcoming.{$limit}", 1800, function() use ($limit) {
            return Event::upcoming($limit)->get();
        });
    }

    public function getFeaturedEvents(): Collection
    {
        return Cache::remember('events.featured', 1800, function() {
            return Event::active()->featured()->get();
        });
    }

    public function getRecurringEvents(): Collection
    {
        return Event::active()
                   ->whereNotNull('day_of_week')
                   ->orderBy('day_of_week')
                   ->get();
    }

    public function getEventsByDateRange(Carbon $start, Carbon $end): Collection
    {
        return Event::active()
                   ->whereBetween('event_date', [$start, $end])
                   ->orderBy('event_date')
                   ->orderBy('event_time')
                   ->get();
    }

    public function clearCache(): void
    {
        Cache::forget('events.featured');
        
        // Limpar cache de upcoming events (diferentes limites)
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("events.upcoming.{$i}");
        }
    }
}
```

---

## 🎮 **CONTROLLERS REFATORADOS**

### **HomeController.php**
```php
<?php

namespace App\Http\Controllers;

use App\Services\HomeContentService;
use App\Services\EventService;

class HomeController extends Controller
{
    public function __construct(
        private HomeContentService $homeService,
        private EventService $eventService
    ) {}

    public function index()
    {
        $data = $this->homeService->getHomePageData();
        $data['events'] = $this->eventService->getUpcomingEvents();

        return view('home', $data);
    }
}
```

---

## 📱 **ADMIN PANEL (OPCIONAL)**

### **Admin Controllers:**
```php
// Admin/HomeSectionController.php
// Admin/EventController.php  
// Admin/SiteSettingController.php
// Admin/DashboardController.php
```

### **Funcionalidades Admin:**
- ✅ **CRUD Seções** - Criar, editar, deletar seções
- ✅ **Toggle Visibilidade** - Mostrar/ocultar seções
- ✅ **Drag & Drop** - Reordenar seções e cards
- ✅ **Editor WYSIWYG** - Para conteúdo HTML
- ✅ **Upload Imagens** - Para backgrounds e ícones
- ✅ **Gestão Eventos** - CRUD completo com recorrência
- ✅ **Configurações Site** - Editar dados de contato, redes sociais
- ✅ **Preview** - Visualizar mudanças antes de publicar
- ✅ **Cache Management** - Limpar cache com um clique

---

## 🚀 **FASES DE IMPLEMENTAÇÃO**

### **📦 Fase 1: Estrutura Base** ⏱️ ~2h
- [x] Criar migrations das tabelas
- [x] Implementar Models com relacionamentos
- [x] Criar Seeders com dados atuais da home
- [x] Testes básicos de funcionalidade

### **📦 Fase 2: Services e Logic** ⏱️ ~2h  
- [x] Implementar Services para busca de dados
- [x] Refatorar HomeController
- [x] Implementar sistema de cache
- [x] Otimizar queries com eager loading

### **📦 Fase 3: Frontend Dinâmico** ⏱️ ~1h
- [x] Atualizar views Blade para usar dados dinâmicos
- [x] Manter design atual 100%
- [x] Implementar fallbacks para dados ausentes
- [x] Testes de funcionalidade frontend

### **📦 Fase 4: Admin Panel** ⏱️ ~4h
- [x] Interface administrativa com Laravel
- [x] Formulários de edição CRUD
- [x] Sistema de upload de imagens
- [x] Dashboard com estatísticas
- [x] Sistema de autenticação admin

### **📦 Fase 5: Otimizações** ⏱️ ~1h
- [x] Cache inteligente com invalidação
- [x] SEO dinâmico com meta tags
- [x] Performance monitoring
- [x] Documentação completa

---

## 🎯 **DADOS INICIAIS (SEEDERS)**

### **Seções da Home:**
1. **Hero** - Título principal, subtitle, imagem de fundo
2. **About** - Título "Sobre Nossa Casa" + 3 cards
3. **Events** - Título "Giras e Eventos" 
4. **Contact** - Título "Entre em Contato" + dados

### **Configurações Site:**
- Dados de contato (telefone, email, WhatsApp)
- Endereço completo
- Horários de funcionamento  
- Links redes sociais
- Meta tags SEO

### **Eventos Iniciais:**
- Gira de Caboclos (Sextas 20h)
- Gira de Pretos-Velhos (Segundas 20h)
- Gira de Exú (1ª Sexta do mês 20h)

---

## ✅ **VANTAGENS DA IMPLEMENTAÇÃO**

### **Para Administradores:**
- ✅ **Controle Total** - Editar qualquer texto sem tocar no código
- ✅ **Interface Intuitiva** - Admin panel fácil de usar
- ✅ **Flexibilidade** - Mostrar/ocultar seções conforme necessário
- ✅ **Gestão de Eventos** - Criar eventos únicos ou recorrentes
- ✅ **Upload Simples** - Trocar imagens via interface web

### **Para Desenvolvedores:**
- ✅ **Código Limpo** - Separação clara de responsabilidades
- ✅ **Performance** - Cache inteligente e queries otimizadas
- ✅ **Manutenibilidade** - Arquitetura escalável e testável
- ✅ **Flexibilidade** - Fácil adicionar novas funcionalidades

### **Para o Site:**
- ✅ **SEO Otimizado** - Meta tags dinâmicas
- ✅ **Performance** - Cache de dados e queries eficientes
- ✅ **Responsivo** - Design atual mantido 100%
- ✅ **Acessibilidade** - Todos os recursos WCAG preservados

---

## 🔄 **ESTRATÉGIA DE MIGRAÇÃO**

### **Segurança:**
1. **Backup Completo** - Views atuais salvas como .backup
2. **Migração Gradual** - Implementar seção por seção
3. **Fallbacks** - Se dado não existir, usar valores padrão
4. **Testes Extensivos** - Garantir zero breaking changes

### **Timeline:**
- **Semana 1**: Fases 1 e 2 (estrutura + logic)
- **Semana 2**: Fase 3 (frontend dinâmico) 
- **Semana 3**: Fase 4 (admin panel)
- **Semana 4**: Fase 5 (otimizações + testes)

---

## 📝 **COMANDOS ÚTEIS**

```bash
# Criar estrutura
php artisan make:model HomeSection -mfs
php artisan make:model Event -mfs
php artisan make:service HomeContentService
php artisan make:service EventService

# Executar migrations
php artisan migrate

# Popular dados iniciais
php artisan db:seed --class=HomeSectionsSeeder
php artisan db:seed --class=EventsSeeder

# Limpar caches
php artisan cache:clear
php artisan view:clear
```

---

**🌿⚔️ Plano aprovado e salvo! Pronto para implementação quando necessário. Axé! ✨**

---

*Data de criação: 18/10/2025*  
*Status: Aguardando aprovação para implementação*  
*Prioridade: Médio (após ajustes de layout)*
