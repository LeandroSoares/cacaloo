# 📋 Guia para Agentes de IA - Sistema Cacaloo

---

## 🎯 **LEITURA OBRIGATÓRIA**

**Antes de trabalhar no projeto, leia TODA esta documentação:**

### **📚 Documentação Principal (NOVA ESTRUTURA)**
1. **[Documentação Técnica Completa](DOCUMENTACAO_TECNICA_COMPLETA.md)** - Arquitetura, autenticação, formulários, design system e CRUD completos
2. **[Planejamento, Execução e Controle](PLANEJAMENTO_EXECUCAO_CONTROLE.md)** - Status do projeto, roadmap, métricas e controle de qualidade

### **📋 Especificações de Features**
- **[Sistema de Convites](especificacoes-features/sistema-convites.md)** - Convites específicos e anônimos com WhatsApp
- **[Formulários Espirituais](especificacoes-features/formularios-espirituais.md)** - 15 formulários Livewire completos 
- **[CRUD Administrativo](especificacoes-features/crud-administrativo.md)** - Sistema CRUD admin completo
- **[Sistema de Conteúdo Dinâmico](especificacoes-features/sistema-conteudo-dinamico.md)** - Homepage gerenciável via admin

### **🛠️ Recursos Auxiliares**
- **[DEPLOY.md](DEPLOY.md)** - Configurações de produção e deploy

### **📂 NOVA ESTRUTURA DE DOCUMENTAÇÃO**
**⚠️ ATENÇÃO:** A documentação foi completamente reorganizada. **NÃO use mais** os arquivos antigos:
- ~~ARQUITETURA.md~~ → Consolidado em `DOCUMENTACAO_TECNICA_COMPLETA.md`
- ~~AUTENTICACAO.md~~ → Consolidado em `DOCUMENTACAO_TECNICA_COMPLETA.md`
- ~~FORMULARIOS_ESPIRITUAIS.md~~ → Consolidado em `DOCUMENTACAO_TECNICA_COMPLETA.md`
- ~~CRUD_ADMIN_SYSTEM.md~~ → Consolidado em `DOCUMENTACAO_TECNICA_COMPLETA.md`
- ~~README_COMPLETO.md~~ → Consolidado em `PLANEJAMENTO_EXECUCAO_CONTROLE.md`
- ~~STATUS_ATUAL_PROJETO.md~~ → Consolidado em `PLANEJAMENTO_EXECUCAO_CONTROLE.md`

**✅ Use apenas:**
- **3 documentos principais** para informações gerais
- **Especificações individuais** em `especificacoes-features/` para features específicas
- **Históricos** em `historicos/` apenas para referência

---

## 🤖 **INSTRUÇÕES PARA AGENTES DE IA**

### **🔍 ANTES DE COMEÇAR**

#### **1. Identifique a Área de Trabalho:**
- **🌐 Área Pública (/)** - Site institucional, sem autenticação
- **👤 Área do Usuário (/dashboard)** - Usuários autenticados
- **🛠️ Área Admin (/admin)** - Administradores da casa
- **⚙️ Área SysAdmin (/sysadmin)** - Super administradores técnicos

#### **2. Verifique o Status Atual do Sistema:**
- **✅ PRODUÇÃO v2.1:** Sistema funcionando em cacaloo.com.br
- **✅ Sistema de Convites:** Específicos + anônimos + WhatsApp (100% funcional)
- **✅ Formulários Espirituais:** 15 formulários Livewire (100% Excel substituído)
- **✅ CRUD Administrativo:** Sistema admin completo (4 áreas: users, invitations, personal-data, religious-info)
- **✅ Sistema de Níveis:** user, admin, sysadmin com middleware de proteção
- **📋 EM PLANEJAMENTO:** Sistema de conteúdo dinâmico para homepage

#### **3. Contextualize-se:**
Este é um sistema para uma **casa espiritual de Umbanda**. Mantenha sempre:
- Respeito ao contexto religioso
- Terminologia adequada
- Identidade visual espiritual (cores Oxóssi/Ogum)

---

## 🏗️ **PADRÕES OBRIGATÓRIOS**

### **💻 Código Laravel:**

#### **Controllers (Magros):**
```php
<?php
// ✅ CORRETO
class UserController extends Controller
{
    public function __construct(private UserService $userService) {}
    
    public function store(UserRequest $request)
    {
        $user = $this->userService->create($request->validated());
        return redirect()->route('users.show', $user);
    }
}
```

#### **Services (Lógica de Negócio):**
```php
<?php
// ✅ CORRETO
class UserService
{
    public function create(array $data): User
    {
        return DB::transaction(function() use ($data) {
            $user = User::create($data);
            $this->assignDefaultRole($user);
            return $user;
        });
    }
}
```

#### **Form Requests (Validação):**
```php
<?php
// ✅ CORRETO
class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ];
    }
}
```

### **⚡ Livewire Components:**
```php
<?php
// ✅ PADRÃO CORRETO
class PersonalDataForm extends Component
{
    public $name;
    public $email;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $data = PersonalData::where('user_id', auth()->id())->first();
        if ($data) $this->fill($data->toArray());
    }

    public function save()
    {
        $validated = $this->validate();
        PersonalData::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        session()->flash('message', 'Dados salvos com sucesso!');
    }

    public function render()
    {
        return view('livewire.personal-data-form');
    }
}
```

### **🗄️ Models Eloquent:**
```php
<?php
// ✅ PADRÃO CORRETO
class PersonalData extends Model
{
    use HasUuids;
    
    protected $fillable = ['user_id', 'name', 'email', 'cpf'];
    
    protected $casts = [
        'birth_date' => 'date',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }
}
```

---

## 🛡️ **SEGURANÇA OBRIGATÓRIA**

### **🔐 Middleware de Proteção:**

#### **Aplicar Middleware Sempre:**
```php
<?php
// ✅ ROTAS PROTEGIDAS
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});

Route::middleware(['auth', AdminAccess::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
    });
});

Route::middleware(['auth', SysAdminAccess::class])->group(function () {
    Route::prefix('sysadmin')->group(function () {
        Route::get('/dashboard', [SysAdminController::class, 'dashboard']);
    });
});
```

#### **Verificações em Blade:**
```blade
{{-- ✅ SEMPRE VERIFICAR PERMISSÕES --}}
@auth
    @role('admin')
        <a href="{{ route('admin.dashboard') }}">Área Administrativa</a>
    @endrole
    
    @role('sysadmin')
        <a href="{{ route('sysadmin.dashboard') }}">Área de Sistema</a>
    @endrole
@endauth
```

### **📝 Validação Obrigatória:**
```php
<?php
// ✅ SEMPRE VALIDAR ENTRADAS
protected $rules = [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'cpf' => 'required|string|size:11|cpf', // Validação customizada
];

// ✅ MENSAGENS PERSONALIZADAS
protected $messages = [
    'name.required' => 'O nome é obrigatório.',
    'email.unique' => 'Este e-mail já está em uso.',
    'cpf.cpf' => 'CPF inválido.',
];
```

---

## 🎨 **DESIGN SYSTEM**

### **🌈 Cores Espirituais (OBRIGATÓRIO):**
```css
/* ✅ CORES OFICIAIS */
.oxossi { color: #2E7D32; }      /* Verde de Oxóssi */
.ogum { color: #C62828; }        /* Vermelho de Ogum */
.gold { color: #D4AF37; }        /* Ouro sagrado */
.forest { color: #1B4332; }      /* Verde floresta */
```

### **📱 Responsividade (OBRIGATÓRIO):**
```blade
{{-- ✅ SEMPRE MOBILE FIRST --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="p-4 sm:p-6 lg:p-8">
        <h2 class="text-lg sm:text-xl lg:text-2xl">Título</h2>
    </div>
</div>
```

### **🧩 Componentes Padrão:**
```blade
{{-- ✅ USAR COMPONENTES EXISTENTES --}}
<x-ui.button variant="primary" size="md">
    Salvar Dados
</x-ui.button>

<x-ui.card>
    <x-slot name="header">Dados Pessoais</x-slot>
    Conteúdo do card
</x-ui.card>
```

---

## 📊 **BANCO DE DADOS**

### **🆔 UUIDs Obrigatórios:**
```php
<?php
// ✅ SEMPRE USAR UUIDs
class NovoModel extends Model
{
    use HasUuids;
    
    protected $keyType = 'string';
    public $incrementing = false;
}
```

### **🔗 Relacionamentos Padrão:**
```php
<?php
// ✅ SEMPRE COM USER
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

// ✅ EAGER LOADING
$users = User::with(['personalData', 'religiousInfo'])->get();
```

### **📅 Migrations com UUIDs:**
```php
<?php
// ✅ PADRÃO DE MIGRATION
Schema::create('nova_tabela', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
    $table->string('nome');
    $table->timestamps();
    
    $table->index('user_id');
});
```

---

## 🧪 **TESTES OBRIGATÓRIOS**

### **📝 Feature Tests:**
```php
<?php
// ✅ SEMPRE CRIAR TESTES
class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_register_with_invitation()
    {
        // Arrange
        $invitation = Invitation::factory()->create();
        
        // Act
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => $invitation->email,
            'invitation_token' => $invitation->token,
        ]);
        
        // Assert
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => $invitation->email]);
    }
}
```

---

## 📝 **TEMPLATES BLADE**

### **🎭 Layout Base:**
```blade
{{-- ✅ ESTRUTURA PADRÃO --}}
<div class="p-6 bg-white rounded-lg shadow-md mb-8 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-oxossi" fill="currentColor" viewBox="0 0 20 20">
            <!-- Ícone SVG -->
        </svg>
        Título da Seção
    </h2>
    
    {{-- Mensagens de Feedback --}}
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
    
    {{-- Conteúdo --}}
    <div class="space-y-6">
        {{ $slot }}
    </div>
</div>
```

---

## 🚨 **ERROS COMUNS A EVITAR**

### **❌ NÃO FAÇA:**
```php
<?php
// ❌ Controller gordo
class UserController extends Controller
{
    public function store(Request $request)
    {
        // ❌ Validação no controller
        $request->validate([...]);
        
        // ❌ Lógica de negócio no controller
        $user = User::create($request->all());
        $user->assignRole('user');
        Mail::to($user)->send(new WelcomeMail());
        
        return redirect('/dashboard');
    }
}

// ❌ Model sem fillable
class User extends Model
{
    // ❌ Permite mass assignment vulnerabilities
}

// ❌ Rota sem proteção
Route::get('/admin/users', [UserController::class, 'index']);
```

### **✅ FAÇA:**
```php
<?php
// ✅ Controller magro
class UserController extends Controller
{
    public function store(UserRequest $request, UserService $service)
    {
        $user = $service->create($request->validated());
        return redirect()->route('dashboard');
    }
}

// ✅ Model com fillable
class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
}

// ✅ Rota protegida
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
});
```

---

## 📋 **CHECKLIST DE DESENVOLVIMENTO**

### **Antes de Implementar:**
- [ ] Li toda a documentação do projeto
- [ ] Identifiquei a área de trabalho (public/user/admin/sysadmin)
- [ ] Verifiquei a fase atual do projeto
- [ ] Entendi o contexto espiritual da aplicação

### **Durante o Desenvolvimento:**
- [ ] Seguindo padrões Laravel (Controllers magros, Services, Form Requests)
- [ ] Aplicando middleware de segurança adequado
- [ ] Usando UUIDs em novos models
- [ ] Implementando validação adequada
- [ ] Mantendo design system (cores espirituais)
- [ ] Garantindo responsividade mobile-first
- [ ] Criando componentes reutilizáveis

### **Após Implementar:**
- [ ] Criei testes automatizados
- [ ] Testei em diferentes níveis de permissão
- [ ] Verifiquei responsividade
- [ ] Validei acessibilidade básica
- [ ] Documentei mudanças significativas

---

## 🔍 **COMANDOS ÚTEIS PARA DEBUGGING**

```bash
# Limpar caches durante desenvolvimento
php artisan optimize:clear

# Ver rotas registradas
php artisan route:list

# Verificar configurações
php artisan config:show

# Executar testes
php artisan test

# Ver logs em tempo real
tail -f storage/logs/laravel.log

# Verificar permissões Spatie
php artisan permission:show

# Recriar banco com dados iniciais
php artisan migrate:fresh --seed
```

---

## 📞 **QUANDO PRECISAR DE AJUDA**

### **🔍 Consulte Primeiro:**
1. Esta documentação completa
2. Código existente similar
3. Logs do sistema (`storage/logs/`)
4. Testes automatizados

### **🧪 Teste Sempre:**
- Diferentes papéis de usuário (user/admin/sysadmin)
- Responsividade em móveis
- Validações de formulário
- Cenários de erro

### **📝 Documente:**
- Mudanças na arquitetura
- Novas funcionalidades
- Configurações especiais
- Comandos específicos

---

## 🎯 **OBJETIVOS DO PROJETO**

### **Sistema Atual (v2.1 - PRODUÇÃO):**
- ✅ **Sistema completo funcionando** em cacaloo.com.br
- ✅ **15 formulários Livewire** - 100% do Excel substituído
- ✅ **Sistema de convites robusto** - específicos, anônimos, WhatsApp
- ✅ **CRUD admin completo** - 4 áreas administrativas funcionais
- ✅ **3 níveis de usuário** - user, admin, sysadmin com middleware

### **Próximas Implementações Planejadas:**
- **📋 Sistema de Conteúdo Dinâmico:** Homepage editável via admin
- **📅 Calendário de Eventos:** Gestão completa de giras e trabalhos
- **🎓 Gestão de Cursos:** Sistema educacional para desenvolvimento mediúnico

### **Sempre Lembrar:**
- Este é um sistema para uma **casa espiritual**
- Segurança é **fundamental** (apenas pessoas convidadas)
- Respeito ao **contexto religioso** da Umbanda
- Código **limpo e testável**
- **Performance** e **acessibilidade**

---

**🌿⚔️ Que os agentes de IA trabalhem com axé e sabedoria tecnológica! ✨**

---

## 📋 **CONTEXTO ATUAL DO PROJETO (NOVEMBRO 2025)**

### **🎯 Status: SISTEMA EM PRODUÇÃO v2.1**
- **Site funcionando:** cacaloo.com.br
- **Usuários ativos:** Casa utilizando sistema completamente
- **Excel substituído:** 100% dos formulários digitalizados
- **Documentação:** Totalmente reorganizada e unificada

### **🔄 Mudanças Recentes na Documentação**
- **Documentos consolidados:** De 40+ arquivos para 3 principais + features
- **Estrutura nova:** Técnica, Planejamento e Especificações separadas
- **Histórico preservado:** Arquivos antigos em `historicos/` para referência
- **Features organizadas:** Cada funcionalidade com especificação detalhada

### **⚠️ IMPORTANTE PARA AGENTES**
- **Use a nova estrutura:** Não referencie arquivos antigos (ARQUITETURA.md, AUTENTICACAO.md, etc.)
- **Consulte as especificações:** Cada feature tem documentação completa em `especificacoes-features/`
- **Sistema estável:** Mudanças devem ser cuidadosas - sistema em produção
- **Backup sempre:** Qualquer alteração deve ter estratégia de rollback

---

*Guia atualizado em: 02/11/2025*  
*Para agentes trabalhando no Sistema Cacaloo - v2.1 PRODUÇÃO*
