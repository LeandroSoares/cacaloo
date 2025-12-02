# 🌐 Sistema de Conteúdo Dinâmico - Especificação Técnica

## 📋 **OBJETIVOS DA FEATURE**

### **Objetivo Principal**
Transformar o site estático em um sistema dinâmico gerenciável via painel administrativo, permitindo edição de conteúdo sem necessidade de alterações no código-fonte.

### **Objetivos Específicos**
- **Flexibilidade de Conteúdo**: Permitir edição de textos, imagens e configurações via interface web
- **Gestão de Eventos**: Sistema completo para criar, editar e gerenciar eventos únicos e recorrentes
- **Performance Otimizada**: Implementar cache inteligente para manter velocidade de carregamento
- **Manutenibilidade**: Separar conteúdo de apresentação seguindo padrões Laravel modernos
- **SEO Dinâmico**: Meta tags editáveis via painel administrativo

---

## 🎯 **FUNCIONALIDADES PRINCIPAIS**

### **1. Gestão de Seções da Homepage**
- **Seções Configuráveis**: Hero, About, Events, Contact com conteúdo editável
- **Sistema de Cards**: Cards filhos para seções About e outras que necessitem
- **Controle de Visibilidade**: Toggle para mostrar/ocultar seções
- **Ordenação**: Drag & drop para reordenar seções e cards
- **Editor Rico**: Interface WYSIWYG para conteúdo HTML

### **2. Sistema de Eventos**
- **Eventos Únicos**: Data específica com título, descrição e horário
- **Eventos Recorrentes**: Baseados em dia da semana (ex: "Toda sexta às 20h")
- **Eventos em Destaque**: Sistema de featured events para homepage
- **Cores Personalizáveis**: Background colors para diferentes tipos de eventos
- **Status Active/Inactive**: Controle de publicação de eventos

### **3. Configurações do Site**
- **Dados de Contato**: Telefone, email, WhatsApp, endereço
- **Redes Sociais**: Links para Instagram, Facebook, YouTube
- **Horários de Funcionamento**: Horários editáveis
- **Meta Tags SEO**: Título, descrição, keywords dinâmicas
- **Configurações Avançadas**: JSON para configurações complexas

### **4. Painel Administrativo**
- **Dashboard**: Visão geral das seções, eventos e configurações
- **Interface Intuitiva**: Formulários simples para edição
- **Upload de Imagens**: Sistema para backgrounds e ícones
- **Preview**: Visualizar mudanças antes de publicar
- **Cache Management**: Botão para limpar cache com um clique

---

## 👥 **CASOS DE USO**

### **Para Administradores do Site**
1. **Atualizar Informações de Evento**
   - Acessar painel admin
   - Editar data/horário de gira específica
   - Salvar e publicar automaticamente

2. **Modificar Texto da Homepage**
   - Entrar na seção "About" no admin
   - Editar texto usando editor visual
   - Visualizar preview antes de salvar

3. **Adicionar Novo Evento Recorrente**
   - Criar evento tipo "Toda segunda às 19h"
   - Configurar título, descrição e cor
   - Ativar para aparecer na homepage

### **Para Desenvolvedores**
1. **Manter Performance**
   - Sistema de cache automático preserva velocidade
   - Queries otimizadas com eager loading
   - Invalidação inteligente de cache

2. **Expandir Funcionalidades**
   - Arquitetura modular facilita adições
   - Services isolam lógica de negócio
   - Models com relationships bem definidos

### **Para Visitantes do Site**
1. **Experiência Inalterada**
   - Design atual preservado 100%
   - Performance mantida ou melhorada
   - SEO otimizado com meta tags dinâmicas

---

## 🛠 **IMPLEMENTAÇÃO TÉCNICA**

### **Estrutura do Banco de Dados**

#### **Tabela: site_home_sections**
```sql
- id (UUID, PK)
- section_key (VARCHAR, UNIQUE) - 'hero', 'about', 'events', 'contact'
- title (VARCHAR) - Título da seção
- subtitle (TEXT) - Subtítulo ou descrição
- content (LONGTEXT) - Conteúdo HTML da seção
- background_image (VARCHAR) - URL da imagem de fundo
- background_color (VARCHAR) - Cor de fundo hexadecimal
- is_visible (BOOLEAN) - Controle de visibilidade
- display_order (INTEGER) - Ordem de exibição
- created_at, updated_at (TIMESTAMPS)
```

#### **Tabela: site_home_cards**
```sql
- id (UUID, PK)
- home_section_id (UUID, FK) - Relacionamento com seção pai
- title (VARCHAR) - Título do card
- content (TEXT) - Conteúdo do card
- icon_class (VARCHAR) - Classe do ícone (Font Awesome)
- image_url (VARCHAR) - URL de imagem do card
- link_url (VARCHAR) - URL de destino (opcional)
- is_visible (BOOLEAN) - Controle de visibilidade
- display_order (INTEGER) - Ordem dentro da seção
- created_at, updated_at (TIMESTAMPS)
```

#### **Tabela: events**
```sql
- id (UUID, PK)
- title (VARCHAR) - Nome do evento
- description (TEXT) - Descrição detalhada
- event_date (DATE) - Data específica (NULL para recorrentes)
- event_time (TIME) - Horário do evento
- day_of_week (ENUM) - Para eventos recorrentes
- recurrence_type (ENUM) - 'weekly', 'monthly', 'unique'
- background_color (VARCHAR) - Cor de fundo
- is_active (BOOLEAN) - Status de publicação
- is_featured (BOOLEAN) - Destaque na homepage
- created_at, updated_at (TIMESTAMPS)
```

#### **Tabela: site_settings**
```sql
- id (UUID, PK)
- key (VARCHAR, UNIQUE) - Chave de configuração
- value (LONGTEXT) - Valor (string, JSON)
- type (ENUM) - 'string', 'json', 'boolean', 'number'
- description (TEXT) - Descrição da configuração
- group_name (VARCHAR) - Agrupamento lógico
- is_editable (BOOLEAN) - Permite edição via admin
- created_at, updated_at (TIMESTAMPS)
```

### **Models Laravel**

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
        'background_image', 'background_color', 
        'is_visible', 'display_order'
    ];

    protected $casts = [
        'is_visible' => 'boolean'
    ];

    // Relacionamentos
    public function cards(): HasMany
    {
        return $this->hasMany(HomeSectionCard::class, 'home_section_id');
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

### **Services para Lógica de Negócio**

#### **HomeContentService.php**
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

    public function clearCache(): void
    {
        Cache::forget('homepage.data');
        Cache::forget('settings.frontend');
        
        $sections = HomeSection::pluck('section_key');
        foreach ($sections as $key) {
            Cache::forget("section.{$key}");
        }
    }
}
```

### **Controllers Refatorados**

#### **HomeController.php**
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

## 📊 **MÉTRICAS E VALIDAÇÃO**

### **Métricas de Performance**
- **Tempo de Carregamento**: Manter < 2s após implementação
- **Cache Hit Rate**: > 85% para dados da homepage
- **Queries por Request**: Reduzir de 15+ para máximo 5
- **Memory Usage**: Monitorar uso de memória com cache ativo

### **Métricas de Usabilidade**
- **Tempo de Edição**: < 30s para alterar texto simples
- **Tempo de Upload**: < 10s para imagens até 2MB  
- **Learning Curve**: Admin deve conseguir usar sem treinamento
- **Mobile Friendly**: Interface admin responsiva

### **Métricas de Qualidade**
- **Uptime**: 99.9% após migração
- **Zero Breaking Changes**: Funcionalidade atual preservada
- **SEO Score**: Manter ou melhorar score atual
- **Accessibility**: Preservar conformidade WCAG

### **Critérios de Aceitação**
- ✅ Todas as seções atuais funcionando identicamente
- ✅ Admin consegue editar qualquer texto sem suporte técnico
- ✅ Performance igual ou superior ao site atual
- ✅ Sistema de backup automático funcionando
- ✅ Cache invalidation funcionando corretamente

---

## 🚀 **FASES DE IMPLEMENTAÇÃO**

### **Fase 1: Estrutura Base** ⏱️ ~2h
- [x] Criar migrations das 4 tabelas principais
- [x] Implementar Models com relationships
- [x] Criar Seeders com dados atuais da homepage
- [x] Testes básicos de Models e relationships

### **Fase 2: Services e Lógica** ⏱️ ~2h  
- [x] Implementar HomeContentService e EventService
- [x] Refatorar HomeController para usar Services
- [x] Implementar sistema de cache com Redis/File
- [x] Otimizar queries com eager loading

### **Fase 3: Frontend Dinâmico** ⏱️ ~1h
- [x] Atualizar views Blade para dados dinâmicos
- [x] Manter design atual 100% inalterado
- [x] Implementar fallbacks para dados ausentes
- [x] Testes funcionais do frontend

### **Fase 4: Painel Administrativo** ⏱️ ~4h
- [x] Criar controllers admin (CRUD completo)
- [x] Interface administrativa com Blade/Livewire
- [x] Formulários de edição com validação
- [x] Sistema de upload de imagens
- [x] Dashboard com estatísticas básicas

### **Fase 5: Otimizações e Deploy** ⏱️ ~1h
- [x] Cache inteligente com invalidação automática
- [x] SEO dinâmico com meta tags editáveis
- [x] Performance monitoring e logging
- [x] Documentação completa para usuários

---

## 🔄 **ESTRATÉGIA DE MIGRAÇÃO**

### **Preparação**
1. **Backup Completo**: Views atuais salvas como `.backup`
2. **Ambiente de Teste**: Migração testada em ambiente isolado
3. **Dados de Seed**: Popular banco com conteúdo atual
4. **Rollback Plan**: Procedimento de volta ao sistema atual

### **Execução**
1. **Deploy Database**: Executar migrations em produção
2. **Seed Data**: Popular com conteúdo atual via seeders
3. **Update Views**: Substituir views estáticas por dinâmicas
4. **Cache Warm**: Pre-popular cache com dados essenciais
5. **Smoke Tests**: Verificar funcionamento básico

### **Validação**
1. **Functional Tests**: Todas as páginas carregando
2. **Performance Tests**: Tempos de resposta mantidos
3. **Visual Tests**: Design idêntico ao anterior
4. **Admin Tests**: Painel administrativo funcional

---

## 📚 **DOCUMENTAÇÃO E TREINAMENTO**

### **Documentação Técnica**
- **README**: Comandos de instalação e configuração
- **API Docs**: Endpoints do admin (se aplicável)
- **Database Schema**: Diagramas ER das tabelas
- **Service Docs**: Documentação dos Services criados

### **Manual do Usuário**
- **Guia do Admin**: Como usar o painel administrativo
- **Screenshots**: Interface com explicações passo-a-passo
- **Video Tutorial**: Gravação de 10min mostrando uso básico
- **FAQ**: Dúvidas comuns e resoluções

### **Comandos Úteis**
```bash
# Estrutura inicial
php artisan make:model HomeSection -mfs
php artisan make:model HomeSectionCard -mfs
php artisan make:model Event -mfs
php artisan make:model SiteSetting -mfs

# Services
php artisan make:service HomeContentService
php artisan make:service EventService

# Migrations e Seeds
php artisan migrate
php artisan db:seed --class=HomeSectionsSeeder
php artisan db:seed --class=EventsSeeder
php artisan db:seed --class=SiteSettingsSeeder

# Cache Management
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## 🎯 **EVOLUÇÃO FUTURA**

### **Versão 2.0 - Recursos Avançados**
- **Multilingue**: Sistema de tradução para PT/EN/ES
- **A/B Testing**: Testar diferentes versões de conteúdo
- **Analytics**: Dashboard com métricas de engajamento
- **API REST**: Exposição de dados para apps mobile

### **Versão 3.0 - Inteligência**
- **Auto-optimization**: IA para sugerir melhorias de conteúdo
- **Personalization**: Conteúdo personalizado por usuário
- **Scheduling**: Publicação agendada de conteúdo
- **Workflow**: Aprovação de conteúdo por múltiplos usuários

### **Integrações Futuras**
- **CMS Headless**: Separar backend do frontend completamente
- **CDN Integration**: Otimização automática de imagens
- **Social Media**: Auto-post em redes sociais
- **Email Marketing**: Integração com newsletters

---

## ✅ **BENEFÍCIOS ESPERADOS**

### **Para o Negócio**
- **Autonomia**: Editar conteúdo sem dependência técnica
- **Agilidade**: Atualizações em tempo real
- **Flexibilidade**: Adaptar conteúdo para eventos especiais
- **Profissionalismo**: Interface admin moderna e intuitiva

### **Para Desenvolvedores**
- **Manutenibilidade**: Código organizado e testável
- **Escalabilidade**: Arquitetura preparada para crescimento
- **Performance**: Cache otimizado e queries eficientes
- **Modernidade**: Uso de padrões Laravel atuais

### **Para Usuários Finais**
- **Experience**: Zero mudança na experiência do usuário
- **Performance**: Site igual ou mais rápido
- **SEO**: Melhor indexação com meta tags dinâmicas
- **Acessibilidade**: Todos os recursos WCAG preservados

---

**Status**: Pronto para implementação  
**Prioridade**: Média (após ajustes de layout)  
**Estimativa Total**: 10 horas de desenvolvimento  
**ROI Esperado**: Alto - autonomia na gestão de conteúdo

*Axé! 🌿⚔️*