# 📚 Documentação Técnica Completa - Sistema Cacaloo
**Casa de Caridade Legião de Oxóssi e Ogum**

---

## 📋 **ÍNDICE**
1. [Visão Geral da Arquitetura](#-visão-geral-da-arquitetura)
2. [Stack Tecnológico](#-stack-tecnológico)
3. [Estrutura de Diretórios](#-estrutura-de-diretórios)
4. [Regras de Negócio](#-regras-de-negócio)
5. [Sistema de Autenticação](#-sistema-de-autenticação)
6. [Formulários Espirituais](#-formulários-espirituais)
7. [Sistema CRUD Administrativo](#-sistema-crud-administrativo)
8. [Design System](#-design-system)
9. [Padrões de Desenvolvimento](#-padrões-de-desenvolvimento)
10. [Configurações Técnicas](#-configurações-técnicas)

---

## 🏗️ **VISÃO GERAL DA ARQUITETURA**

### **Arquitetura do Sistema:**
O Sistema Cacaloo segue os princípios de **Clean Architecture** e **SOLID**, organizando-se em camadas bem definidas:

```
Sistema Cacaloo v2.1
├── 🌐 Público (/)           # Homepage institucional (guest)
├── 👨‍🎓 Aluno (/aluno)        # Área educacional isolada (aluno)
├── 👤 Usuários (/portal)    # Formulários mediúnicos (user)
├── 🛠️ Admin (/admin)        # CRUD + gestão operacional (manager/admin)
└── ⚙️ SysAdmin (/sysadmin)  # Controle técnico total (sysadmin)
```

### **Princípios Arquiteturais:**
- **Clean Architecture** - Separação clara de responsabilidades
- **SOLID Principles** - Código modular e testável
- **Domain Driven Design** - Organização por domínios espirituais
- **Component Based** - Reutilização máxima de código
- **Feature Flags** - Controle dinâmico de funcionalidades

---

## 🚀 **STACK TECNOLÓGICO**

### **Backend:**
- **Laravel:** 12.25.0 (Framework principal)
- **PHP:** 8.4.11 (Linguagem moderna com features 8.2+)
- **MySQL/MariaDB:** Banco de dados com UUIDs
- **Spatie Permission:** Sistema de papéis e permissões
- **Laravel Breeze:** Autenticação base

### **Frontend:**
- **Laravel Livewire:** 3.x (Componentes interativos)
- **Blade Templates:** Motor de templates
- **Tailwind CSS:** Framework CSS utilitário
- **Alpine.js:** JavaScript reativo
- **Vite:** Build tool moderno

### **Infraestrutura:**
- **Docker & Docker Compose:** Containerização
- **Nginx:** Servidor web
- **Supervisor:** Gerenciamento de processos
- **MailHog:** Desenvolvimento de emails

---

## 📁 **ESTRUTURA DE DIRETÓRIOS**

```
app/
├── Console/                 # Comandos Artisan
├── Enums/                   # Enumerações (InvitationType, etc.)
├── Http/
│   ├── Controllers/
│   │   ├── Auth/           # Autenticação e registro
│   │   ├── Admin/          # Área administrativa
│   │   ├── SysAdmin/       # Área de sistema
│   │   └── User/           # Área do usuário
│   ├── Middleware/         # Middleware personalizados
│   ├── Requests/           # Form Requests para validação
│   └── Resources/          # API Resources
├── Livewire/               # Componentes Livewire
├── Models/                 # Models Eloquent
├── Policies/               # Políticas de autorização
├── Providers/              # Service Providers
├── Services/               # Lógica de negócio complexa
├── Utils/                  # Utilitários diversos
└── View/                   # View Composers

resources/
├── views/
│   ├── layouts/            # Layouts base
│   ├── components/         # Componentes Blade
│   ├── admin/              # Views administrativas
│   ├── auth/               # Views de autenticação
│   └── livewire/           # Views dos componentes Livewire
├── css/
└── js/

database/
├── factories/              # Factories para testes
├── migrations/             # Migrações do banco
└── seeders/                # Seeders com dados padrão

config/
├── centro.php              # Configurações da casa espiritual
├── features.php            # Feature flags
└── permission.php          # Configurações de permissão
```

---

## � **REGRAS DE NEGÓCIO**

### **🏛️ Regras Institucionais da Casa Espiritual**

#### **RN001 - Acesso Exclusivo por Convite**
- **Regra:** Não existe registro livre no sistema
- **Implementação:** Middleware `GuestOnlyWithInvitation` 
- **Validação:** Token obrigatório para registro
- **Exceção:** Apenas SysAdmins podem criar convites sem restrições

#### **RN002 - Hierarquia Espiritual**
- **Regra:** Níveis de acesso respeitam hierarquia da casa
- **Ordem:** Guest → Aluno → User → Manager → Admin → SysAdmin
- **Implementação:** Spatie Permission com middleware específicos
- **Validação:** Cada nível herda permissões dos inferiores (exceto Aluno que tem área isolada)

#### **RN003 - Dados Espirituais Privados**
- **Regra:** Usuário só acessa próprios dados espirituais
- **Implementação:** Policy `PersonalDataPolicy`
- **Exceção:** Admins podem visualizar para gestão
- **Auditoria:** Log de todos os acessos a dados sensíveis

### **📝 Regras dos Formulários Espirituais**

#### **RN004 - Formulário Único por Usuário**
- **Regra:** Cada formulário pode ter apenas 1 registro por usuário
- **Implementação:** `updateOrCreate()` nos Livewire components
- **Validação:** Chave única `user_id` em todas as tabelas
- **Comportamento:** Edição sobrescreve dados anteriores

#### **RN005 - Campos Obrigatórios Mínimos**
- **Dados Pessoais:** Nome, email, CPF obrigatórios
- **Info Religiosas:** Data de início na Umbanda obrigatória
- **Validação:** Form Requests específicos para cada formulário
- **UX:** Campos destacados em vermelho quando inválidos

#### **RN006 - Integridade dos Dados Espirituais**
- **Regra:** Datas de início sempre anteriores às de término
- **Validação:** Custom rules `after_or_equal` para períodos
- **Exemplo:** Desenvolvimento não pode terminar antes de começar
- **Implementação:** Validação tanto no frontend quanto backend

### **🎫 Regras do Sistema de Convites**

#### **RN007 - Tipos de Convite**
- **Específico:** Email definido, 1 uso, expiração 7 dias
- **Anônimo:** Sem email, múltiplos usos, expiração configurável
- **WhatsApp:** Link direto, rastreamento de origem
- **Implementação:** Enum `InvitationType`

#### **RN008 - Expiração e Segurança**
- **Regra:** Convites expiram automaticamente
- **Específicos:** 7 dias fixos
- **Anônimos:** Configurável pelo admin (padrão 30 dias)
- **Token:** UUID v4 com 64 caracteres
- **Validação:** Middleware verifica validade antes do registro

#### **RN009 - Controle de Uso**
- **Específicos:** Marcado como usado após primeiro registro
- **Anônimos:** Contador de usos (limite configurável)
- **Auditoria:** Log completo de criação e uso de convites
- **Cleanup:** Job automático remove convites expirados

### **🛠️ Regras do Sistema CRUD Admin**

#### **RN010 - Segurança nas Operações**
- **Create:** Apenas Admin/SysAdmin podem criar registros
- **Read:** Admins veem todos, Users veem apenas próprios
- **Update:** Política por tipo de dado (PersonalDataPolicy, etc.)
- **Delete:** Soft delete com auditoria completa

#### **RN011 - Auditoria Obrigatória**
- **Regra:** Toda operação CRUD é logada
- **Dados:** User, ação, timestamp, IP, dados alterados
- **Implementação:** Observer patterns nos Models
- **Retenção:** Logs mantidos por 2 anos mínimo

### **🎨 Regras de Interface e UX**

#### **RN012 - Identidade Visual Espiritual**
- **Cores obrigatórias:** Verde Oxóssi (#2E7D32), Vermelho Ogum (#C62828)
- **Responsividade:** Mobile-first obrigatório
- **Acessibilidade:** Contraste mínimo WCAG AA
- **Iconografia:** Símbolos espirituais respeitosos

#### **RN013 - Feedback ao Usuário**
- **Regra:** Toda ação deve ter feedback visual
- **Sucesso:** Toast verde com ícone de check
- **Erro:** Toast vermelho com detalhes do problema
- **Loading:** Spinner durante operações async
- **Validação:** Destaque em tempo real de campos inválidos

### **⚖️ Regras de Conformidade e Segurança**

#### **RN014 - LGPD e Privacidade**
- **Regra:** Dados pessoais protegidos por criptografia
- **Implementação:** Laravel Encryption para CPF, RG
- **Acesso:** Log de quem acessa dados pessoais
- **Exclusão:** Right to be forgotten implementado

#### **RN015 - Backup e Recuperação**
- **Regra:** Backup automático diário dos dados
- **Retenção:** 30 dias de backups completos
- **Teste:** Restore testado mensalmente
- **Localização:** Armazenamento externo seguro

### **🔄 Regras de Integração**

#### **RN016 - WhatsApp Integration**
- **Regra:** Links de convite válidos no WhatsApp
- **Formato:** `cacaloo.com.br/convite/{token}`
- **Rastreamento:** UTM parameters para analytics
- **Limite:** 100 convites WhatsApp/dia por admin

#### **RN017 - Feature Flags**
- **Regra:** Funcionalidades controláveis dinamicamente
- **Implementação:** `config/features.php`
- **Granularidade:** Por usuário, papel ou global
- **Exemplo:** Desabilitar convites em manutenção

#### **RN018 - Isolamento da Área do Aluno**
- **Regra:** Alunos têm área completamente separada e isolada
- **Acesso Restrito:** Apenas cursos nos quais está matriculado
- **Implementação:** Layout dedicado `/aluno` com middleware `AlunoAccess`
- **Proibições:** Sem acesso à área user, formulários espirituais ou dashboard comum
- **Validação:** Policy `CourseEnrollmentPolicy` verifica matrícula ativa

#### **RN019 - Matrícula em Cursos para Alunos**
- **Regra:** Aluno só visualiza cursos onde possui matrícula ativa
- **Implementação:** Relacionamento `User → Enrollments → Courses`
- **Validação:** Middleware verifica `enrollment.status = 'active'`
- **Exceção:** Administradores podem matricular alunos em cursos
- **Auditoria:** Log de todas as matrículas e cancelamentos

#### **RN020 - Controle da Área do Aluno via Feature Flag**
- **Regra:** Área do aluno pode ser desabilitada dinamicamente
- **Feature Flag:** `aluno_area_enabled` em `config/features.php`
- **Comportamento:** Quando desabilitada, alunos são redirecionados para homepage
- **Implementação:** Middleware `AlunoAccess` verifica feature flag
- **Graceful Degradation:** Mensagem explicativa quando área está desabilitada

#### **RN021 - Restrição de Criação de Convites Admin**
- **Regra:** Apenas SysAdmins podem criar convites do tipo 'admin'
- **Limitação:** Managers podem criar apenas convites 'user' e 'manager'
- **Implementação:** Validação em `InvitationController` e `CreateInvitationRequest`
- **Interface:** Dropdown de tipos filtrado baseado no papel do usuário logado
- **Exceção:** SysAdmins têm acesso a todos os tipos de convite

#### **RN022 - Elevação de Privilégios Pós-Registro**
- **Regra:** Apenas SysAdmins podem promover usuários existentes para Admin
- **Processo:** Mudança de papel deve ser feita via interface administrativa
- **Auditoria:** Log obrigatório de todas as mudanças de papel/permissão
- **Validação:** Policy `UserPromotionPolicy` controla elevação de privilégios
- **Restrição:** Managers não podem promover usuários para níveis iguais ou superiores

#### **RN023 - Restrições CRUD para Managers**
- **Regra:** Managers não podem realizar operações CRUD em usuários ou alunos
- **Limitação:** Manager pode apenas visualizar dados de usuários (somente leitura)
- **Implementação:** Permissões específicas no `RolesAndPermissionsSeeder` via Spatie Laravel Permission
- **Operações Bloqueadas:** Create, Update, Delete de registros user/aluno
- **Permissões Manager:** Apenas `user.view`, sem `user.create`, `user.edit`, `user.delete`
- **Convites Limitados:** Managers podem criar apenas convites `common` e `manager`
- **Controle:** Sistema Spatie bloqueia automaticamente ações não autorizadas
- **Exceção:** SysAdmins e Admins mantêm acesso total ao CRUD

 
---

## �🔐 **SISTEMA DE AUTENTICAÇÃO**

### **Níveis de Acesso Implementados:**

#### **1. 🎯 Guest (Visitante)**
- **Acesso:** Área pública do site
- **Permissões:**
  - Visualizar homepage institucional
  - Acessar formulário de contato
  - Ver eventos públicos
  - Acessar páginas de login/registro

#### **2. �‍🎓 Aluno (Estudante)**
- **Acesso:** Área educacional isolada `/aluno`
- **Layout:** Dedicado e específico para estudantes
- **Permissões Exclusivas:**
  - **Dados Pessoais (RN024):**
    - ✅ CRUD completo nos próprios dados pessoais
    - ❌ Não vê dados pessoais de outros usuários
  - Visualizar APENAS cursos nos quais está matriculado
  - Acessar material didático dos cursos inscritos
  - Visualizar progresso individual de aprendizado
  - Gerenciar dados acadêmicos básicos (nome, email)
- **Restrições:**
  - ❌ **SEM acesso à área `/portal` (user)**
  - ❌ **SEM acesso aos formulários espirituais**
  - ❌ **SEM acesso ao dashboard comum**
  - ❌ **SEM acesso a outros cursos não matriculados**

#### **3. � User (Usuário)**
- **Acesso:** Dashboard pessoal `/portal`
- **Permissões:**
  - **Dados Pessoais (RN024):**
    - ✅ CRUD completo nos próprios dados pessoais
    - ❌ Não vê dados pessoais de outros usuários
  - Preencher e editar formulários espirituais (15 formulários)
  - Visualizar próprios dados espirituais
  - Acessar área pessoal completa
  - Consultar eventos disponíveis
- **Hierarquia:** Nível superior ao Aluno, mas sem acesso administrativo

#### **4. 👔 Manager (Gerente)**
- **Acesso:** Área administrativa básica
- **Permissões:**
  - **Dados Pessoais (RN024):**
    - ✅ Visualização simples de qualquer usuário (nome, email, celular)
    - ❌ Não vê CPF, RG, endereço, telefones fixo/trabalho, contato emergência
    - ✅ CRUD completo nos próprios dados pessoais
  - **Limitações CRUD (RN023):**
    - ✅ Apenas visualizar usuários (sem criar/editar/excluir)
    - ✅ Criar convites tipo 'comum' e 'manager'
    - ❌ Não pode criar convites tipo 'admin'
  - Visualizar eventos e cursos
  - Gerar relatórios básicos de visualização

#### **5. 🛠️ Admin (Administrador)**
- **Acesso:** Área administrativa completa + todas as anteriores
- **Permissões Principais:**
  - **Dados Pessoais (RN024):**
    - ✅ Visualização completa de todos os dados (CPF, RG, endereços, telefones)
    - ❌ Não pode editar dados pessoais de outros usuários
    - ✅ Pode editar apenas seus próprios dados pessoais
  - **Gestão Completa de Convites:**
    - Criar convites específicos (com email) ou anônimos (sem email)
    - Definir tipo de usuário criado (comum ou admin)
    - Configurar prazo de validade (1-30 dias)
    - Editar, cancelar e gerenciar convites
  - **Integração WhatsApp:**
    - Gerar mensagens formatadas automaticamente
    - Integração com WhatsApp Web
    - Compartilhamento via links seguros
  - **Sistema CRUD Completo:**
    - Gerenciar Cursos (9 cursos padrão)
    - Gerenciar Mistérios (10 mistérios iniciáticos)
    - Gerenciar Orixás (catálogo completo)
    - Gerenciar Tipos de Magia (8 tipos principais)
  - **Feature Flags:** Interface administrativa para controle
  - Editar conteúdo da homepage
  - Gerenciar eventos e giras
  - Visualizar relatórios avançados

#### **6. ⚙️ SysAdmin (Administrador de Sistema)**
- **Acesso:** Total ao sistema + todas as funcionalidades anteriores
- **Permissões Exclusivas:**
  - **Dados Pessoais (RN024):**
    - ✅ Visualização completa de todos os dados pessoais
    - ✅ Editar dados pessoais de qualquer usuário
    - ✅ Acesso total sem restrições (bypass via Gate)
  - **Gestão Técnica Avançada:**
    - Configurações globais do sistema
    - Gerenciamento de feature flags (backend)
    - Acesso aos logs do sistema
    - Configurações de segurança
  - **Controle Total:**
    - Criar, editar e excluir qualquer recurso
    - Gerenciar papéis e permissões
    - Modificar configurações técnicas
    - Acesso completo ao banco de dados

### **Estrutura da Tabela Invitations:**
```sql
CREATE TABLE invitations (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NULL,                    -- Nullable para convites anônimos
    name VARCHAR(255) NULL,                     -- Nome/identificação opcional
    token VARCHAR(255) NOT NULL UNIQUE,
    invited_by BIGINT NOT NULL,
    type ENUM('aluno', 'user', 'manager', 'admin') DEFAULT 'user',  -- Tipo de usuário criado
    status ENUM('pending', 'accepted', 'expired', 'cancelled') DEFAULT 'pending',
    expires_at TIMESTAMP NOT NULL,
    accepted_at TIMESTAMP NULL,
    accepted_by BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (invited_by) REFERENCES users(id),
    FOREIGN KEY (accepted_by) REFERENCES users(id)
);
```

### **Fluxo de Autenticação:**

#### **📋 Criação de Convites:**
1. **Admin acessa** `/admin/invitations/create`
2. **Seleciona método:**
   - 📧 **Específico:** Com email obrigatório
   - 🌐 **Anônimo:** Sem email, com nome/descrição
3. **Define tipo:** User ou Admin
4. **Sistema gera token único** (UUID v4)
5. **Armazena dados** na tabela invitations

#### **🚀 Compartilhamento:**
- **📧 Email específico:** Notificação automática via Laravel Mail
- **📱 WhatsApp:** Link formatado para compartilhamento direto
- **🔗 Link direto:** Cópia manual para qualquer canal

#### **✅ Processo de Registro:**
1. **Usuário acessa link** com token válido
2. **Validação do convite:**
   - Token existe e não expirou
   - Status 'pending'
   - Para específicos: email coincide
3. **Registro liberado** com dados pré-validados
4. **Papel atribuído automaticamente** conforme tipo do convite
5. **Convite atualizado** para status 'accepted'

### **Estrutura da Tabela Course Enrollments:**
```sql
CREATE TABLE course_enrollments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    course_id BIGINT NOT NULL,
    status ENUM('pending', 'active', 'completed', 'cancelled') DEFAULT 'pending',
    enrolled_at TIMESTAMP NOT NULL,
    completed_at TIMESTAMP NULL,
    progress DECIMAL(5,2) DEFAULT 0.00, -- Progresso de 0.00 a 100.00
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_course (user_id, course_id)
);
```

### **Middleware para Área do Aluno:**
```php
<?php
// app/Http/Middleware/AlunoAccess.php
class AlunoAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar se área do aluno está habilitada
        if (!config('features.aluno_area_enabled', true)) {
            return redirect()
                ->route('home')
                ->with('info', 'A área educacional está temporariamente desabilitada. Entre em contato para mais informações.');
        }
        
        // Verificar se usuário tem papel 'aluno'
        if (!Auth::user()->hasRole('aluno')) {
            return redirect()
                ->route('home')
                ->with('error', 'Acesso restrito à área de alunos.');
        }
        
        return $next($request);
    }
}

### **Sistema de Permissões Spatie Laravel Permission:**

```php
<?php
// database/seeders/RolesAndPermissionsSeeder.php (Atualizado)

// Permissões específicas para área do aluno (RN018-RN020)
$alunoPermissions = [
    'aluno.access',                    // Acesso à área do aluno
    'aluno.view.courses',              // Ver cursos matriculados
    'aluno.view.materials',            // Ver materiais dos cursos
    'aluno.update.progress',           // Atualizar progresso
    'course.enroll',                   // Matricular-se em curso
    'course.unenroll',                 // Desmatricular-se
];

// Permissões de convites (RN021-RN022)
$invitePermissions = [
    'invite.view',
    'invite.create',
    'invite.create.common',            // Criar convite tipo comum
    'invite.create.manager',           // Criar convite tipo manager  
    'invite.create.admin',             // Criar convite tipo admin (somente sysadmin)
    'invite.edit',
    'invite.delete',
];

// Papel Admin - acesso administrativo (RN024)
$adminRole = Role::firstOrCreate(['name' => 'admin']);
$adminRole->syncPermissions([
    'user.view', 'user.create', 'user.edit', 'user.delete',
    'personal.data.view.full',         // Ver dados completos de todos usuários
    'personal.data.edit.own',          // Editar próprios dados
    // Nota: Admin NÃO tem 'personal.data.edit.others' - não pode editar dados pessoais
    'invite.view', 'invite.create', 'invite.edit', 'invite.delete',
    'invite.create.common', 'invite.create.manager', 'invite.create.admin',
    'medium_type.view', 'medium_type.create', 'medium_type.edit', 'medium_type.delete',
    'report.view', 'report.export',
    'role.view', 'role.assign.admin', 'role.assign.manager', 'role.assign.user'
]);

// Papel Manager - acesso gerencial limitado (RN023 + RN024)
$managerRole = Role::firstOrCreate(['name' => 'manager']);
$managerRole->syncPermissions([
    'user.view',                       // Apenas visualizar usuários
    'personal.data.view.simple',       // Dados simples: nome, email, celular
    'personal.data.edit.own',          // Editar próprios dados
    'invite.view',                     
    'invite.create.common',            // Criar apenas convites comuns
    'invite.create.manager',           // Criar convites manager
    'medium_type.view',
    'medium_attribute.view',
    'report.view',
    'report.export',
]);

// Papel User - acesso básico (RN024)
$userRole = Role::firstOrCreate(['name' => 'user']);
$userRole->syncPermissions([
    'personal.data.edit.own',          // CRUD completo nos próprios dados
    'medium_type.view',
    'medium_attribute.view',
]);

// Papel Aluno - área educacional isolada (RN018-RN020 + RN024)
$alunoRole = Role::firstOrCreate(['name' => 'aluno']);
$alunoRole->syncPermissions([
    'personal.data.edit.own',          // CRUD completo nos próprios dados
    'aluno.access',                    // Acesso à área do aluno
    'aluno.view.courses',              // Ver apenas cursos matriculados
    'aluno.view.materials',            // Ver materiais dos cursos
    'aluno.update.progress',           // Atualizar progresso
]);
```

// app/Http/Middleware/CourseEnrollmentAccess.php  
class CourseEnrollmentAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('course');
        $user = Auth::user();
        
        // Verificar se aluno está matriculado no curso
        $enrollment = $user->courseEnrollments()
            ->where('course_id', $courseId)
            ->where('status', 'active')
            ->exists();
            
        if (!$enrollment) {
            return redirect()
                ->route('aluno.dashboard')
                ->with('error', 'Você não está matriculado neste curso.');
        }
        
        return $next($request);
    }
}
```

### **Model CourseEnrollment:**
```php
<?php
// app/Models/CourseEnrollment.php
class CourseEnrollment extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'user_id', 'course_id', 'status', 
        'enrolled_at', 'completed_at', 'progress'
    ];
    
    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'progress' => 'decimal:2'
    ];
    
    // Relacionamentos
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    
    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
    
    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }
}
```

### **Controller da Área do Aluno:**
```php
<?php
// app/Http/Controllers/Aluno/AlunoController.php
class AlunoController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Buscar apenas cursos matriculados ativos
        $enrolledCourses = $user->courseEnrollments()
            ->with('course')
            ->where('status', 'active')
            ->get();
            
        $stats = [
            'total_courses' => $enrolledCourses->count(),
            'completed_courses' => $enrolledCourses->where('status', 'completed')->count(),
            'average_progress' => $enrolledCourses->avg('progress'),
        ];
        
        return view('aluno.dashboard', compact('enrolledCourses', 'stats'));
    }
    
    public function showCourse(Course $course)
    {
        $user = Auth::user();
        
        // Verificar matrícula ativa
        $enrollment = $user->courseEnrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->firstOrFail();
            
        return view('aluno.courses.show', compact('course', 'enrollment'));
    }
}
```

### **Rotas da Área do Aluno:**
```php
<?php
// routes/web.php - Área do Aluno (Isolada)
Route::middleware(['auth', AlunoAccess::class])
    ->prefix('aluno')
    ->name('aluno.')
    ->group(function () {
        
        Route::get('/dashboard', [AlunoController::class, 'dashboard'])
            ->name('dashboard');
            
        Route::get('/perfil', [AlunoController::class, 'profile'])
            ->name('profile');
            
        // Cursos - apenas matriculados
        Route::middleware([CourseEnrollmentAccess::class])
            ->group(function () {
                Route::get('/curso/{course}', [AlunoController::class, 'showCourse'])
                    ->name('course.show');
                Route::get('/curso/{course}/material', [AlunoController::class, 'courseMaterial'])
                    ->name('course.material');
            });
    });

// routes/admin.php - Área Administrativa com Controle por Permissões
Route::middleware(['auth', 'role:admin|manager|sysadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Rotas de usuários controladas por permissões Spatie
        Route::resource('users', UserController::class)
            ->middleware('permission:user.view')
            ->except(['create', 'store', 'edit', 'update', 'destroy']);
            
        // Rotas CRUD específicas com permissões granulares
        Route::middleware(['permission:user.create'])
            ->group(function () {
                Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
                Route::post('/users', [UserController::class, 'store'])->name('users.store');
            });
            
        Route::middleware(['permission:user.edit'])
            ->group(function () {
                Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
                Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            });
            
        Route::middleware(['permission:user.delete'])
            ->delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
            
        // Convites com permissões específicas
        Route::middleware(['permission:invite.create.common,invite.create.manager'])
            ->group(function () {
                Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
                Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
            });
    });
```

### **Blade Template para Criação de Convites:**
```blade
{{-- resources/views/admin/invitations/create.blade.php --}}
<form method="POST" action="{{ route('admin.invitations.store') }}">
    @csrf
    
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">
            Nome/Identificação
        </label>
        <input type="text" 
               id="name" 
               name="name" 
               class="mt-1 block w-full rounded-md border-gray-300"
               required>
    </div>
    
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">
            Email (opcional para convites anônimos)
        </label>
        <input type="email" 
               id="email" 
               name="email" 
               class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    
    <div class="mb-4">
        <label for="type" class="block text-sm font-medium text-gray-700">
            Tipo de Usuário
        </label>
        <select id="type" 
                name="type" 
                class="mt-1 block w-full rounded-md border-gray-300" 
                required>
            @foreach($availableTypes as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        
        @if(!isset($availableTypes['admin']))
            <p class="mt-1 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Apenas Super Administradores podem criar convites do tipo Admin.
            </p>
        @endif
    </div>
    
    <div class="mb-4">
        <label for="expires_in_days" class="block text-sm font-medium text-gray-700">
            Expira em (dias)
        </label>
        <select id="expires_in_days" 
                name="expires_in_days" 
                class="mt-1 block w-full rounded-md border-gray-300">
            <option value="7">7 dias</option>
            <option value="15">15 dias</option>
            <option value="30">30 dias</option>
        </select>
    </div>
    
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.invitations.index') }}" 
           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
            Cancelar
        </a>
        <button type="submit" 
                class="px-4 py-2 bg-oxossi-default text-white rounded-md hover:bg-oxossi-dark">
            Criar Convite
        </button>
    </div>
</form>
```

### **Interface para Alteração de Papéis:**
```blade
{{-- resources/views/admin/users/edit-role.blade.php --}}
@can('manage-user-roles', $user)
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">
        Gerenciar Papel do Usuário
    </h3>
    
    <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
        @csrf
        @method('PATCH')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Papel Atual: <span class="font-semibold">{{ $user->getRoleNames()->first() }}</span>
            </label>
            
            <select name="role" class="mt-1 block w-full rounded-md border-gray-300">
                @if(Auth::user()->hasRole('sysadmin'))
                    <option value="aluno" {{ $user->hasRole('aluno') ? 'selected' : '' }}>Aluno</option>
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>Usuário</option>
                    <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Gerente</option>
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Administrador</option>
                @elseif(Auth::user()->hasRole('admin'))
                    <option value="aluno" {{ $user->hasRole('aluno') ? 'selected' : '' }}>Aluno</option>
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>Usuário</option>
                    <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Gerente</option>
                @else
                    <option value="aluno" {{ $user->hasRole('aluno') ? 'selected' : '' }}>Aluno</option>
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>Usuário</option>
                @endif
            </select>
        </div>
        
        @cannot('promote-to-admin')
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <p class="text-sm text-yellow-700">
                    <i class="fas fa-exclamation-triangle"></i>
                    Apenas Super Administradores podem promover usuários para Administrador.
                </p>
            </div>
        @endcannot
        
        <button type="submit" 
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                onclick="return confirm('Tem certeza que deseja alterar o papel deste usuário?')">
            Alterar Papel
        </button>
    </form>
</div>
@endcan
```

### **Comportamento com Feature Flag Desabilitada:**
```php
<?php
// app/Http/Controllers/HomeController.php - Tratamento para alunos
class HomeController extends Controller
{
    public function index()
    {
        // Se usuário é aluno e área está desabilitada
        if (Auth::check() && 
            Auth::user()->hasRole('aluno') && 
            !config('features.aluno_area_enabled', true)) {
            
            return view('home')->with([
                'aluno_area_disabled' => true,
                'contact_info' => config('centro'),
            ]);
        }
        
        return view('home');
    }
}
```

### **Blade Template com Notificação:**
```blade
{{-- resources/views/home.blade.php --}}
@if(isset($aluno_area_disabled) && $aluno_area_disabled)
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    <strong>Área Educacional Temporariamente Indisponível</strong><br>
                    A plataforma de cursos está em manutenção. Entre em contato conosco para mais informações.
                </p>
                <div class="mt-2">
                    <p class="text-sm text-yellow-700">
                        📧 {{ $contact_info['email'] ?? 'contato@cacaloo.com' }}<br>
                        📱 {{ $contact_info['whatsapp'] ?? '(11) 99999-9999' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
```

### **Form Request para Validação de Convites:**
```php
<?php
// app/Http/Requests/CreateInvitationRequest.php
class CreateInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(['admin', 'manager', 'sysadmin']);
    }
    
    public function rules(): array
    {
        return [
            'email' => 'nullable|email|unique:users,email|unique:invitations,email',
            'name' => 'required|string|max:255',
            'type' => [
                'required',
                'string',
                Rule::in($this->getAvailableTypes())
            ],
            'expires_in_days' => 'required|integer|min:1|max:30',
        ];
    }
    
    public function messages(): array
    {
        return [
            'type.in' => 'Você não tem permissão para criar este tipo de convite.',
        ];
    }
    
    private function getAvailableTypes(): array
    {
        return array_keys(InvitationType::availableForUser($this->user()));
    }
}

// app/Http/Controllers/Admin/InvitationController.php
class InvitationController extends Controller
{
    public function create(): View
    {
        $availableTypes = InvitationType::availableForUser(Auth::user());
        
        return view('admin.invitations.create', compact('availableTypes'));
    }
    
    public function store(CreateInvitationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Validação extra para tipo admin
        if ($validated['type'] === InvitationType::ADMIN->value) {
            $this->authorize('create-admin-invitation');
        }
        
        $invitation = Invitation::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'type' => $validated['type'],
            'token' => Str::uuid(),
            'invited_by' => Auth::id(),
            'expires_at' => now()->addDays($validated['expires_in_days']),
        ]);
        
        return redirect()
            ->route('admin.invitations.index')
            ->with('success', 'Convite criado com sucesso!');
    }
}

### **Controllers com Controle por Permissões Spatie:**

```php
<?php
// app/Http/Controllers/Admin/UserController.php
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|manager|sysadmin']);
    }
    
    public function index(): View
    {
        // Spatie automaticamente verifica se usuário tem permissão 'user.view'
        $users = User::with('roles')->paginate(15);
        return view('admin.users.index', compact('users'));
    }
    
    public function create(): View
    {
        // Apenas usuários com permissão 'user.create' acessam
        return view('admin.users.create');
    }
    
    public function store(Request $request): RedirectResponse
    {
        // Validação + criação do usuário
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }
    
    // Métodos edit, update, destroy também protegidos automaticamente pelo Spatie
}

// app/Http/Controllers/InvitationController.php  
class InvitationController extends Controller
{
    public function create(): View
    {
        $availableTypes = [];
        
        // RN021: Managers só podem criar convites common e manager
        if (Auth::user()->can('invite.create.common')) {
            $availableTypes['common'] = 'Usuário Comum';
        }
        
        if (Auth::user()->can('invite.create.manager')) {
            $availableTypes['manager'] = 'Gerente';
        }
        
        if (Auth::user()->can('invite.create.admin')) {
            $availableTypes['admin'] = 'Administrador';
        }
        
        return view('admin.invitations.create', compact('availableTypes'));
    }
}
```
    
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => 'required|string|in:aluno,user,manager,admin'
        ]);
        
        // Verificar permissões via Gate
        $this->authorize('manage-user-roles', $user);
        
        $newRole = $request->role;
        
        // Validação especial para promoção a admin
        if ($newRole === 'admin') {
            $this->authorize('promote-to-admin');
        }
        
        // Log da mudança para auditoria
        Log::info('Role change', [
            'changed_by' => Auth::id(),
            'target_user' => $user->id,
            'old_roles' => $user->getRoleNames()->toArray(),
            'new_role' => $newRole,
            'ip' => $request->ip(),
        ]);
        
        // Remover papéis atuais e adicionar novo
        $user->syncRoles([$newRole]);
        
        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', "Papel do usuário alterado para {$newRole} com sucesso!");
    }
}
```

### **Policy para Promoção de Usuários:**
```php
<?php
// app/Policies/UserPromotionPolicy.php
class UserPromotionPolicy
{
    public function promote(User $currentUser, User $targetUser, string $newRole): bool
    {
        // SysAdmin pode promover qualquer um
        if ($currentUser->hasRole('sysadmin')) {
            return true;
        }
        
        // Admin pode promover, mas não para admin
        if ($currentUser->hasRole('admin')) {
            return !in_array($newRole, ['admin']) && 
                   !$targetUser->hasRole(['admin', 'sysadmin']);
        }
        
        // Manager pode apenas promover users/alunos para manager
        if ($currentUser->hasRole('manager')) {
            return in_array($newRole, ['user', 'manager']) && 
                   $targetUser->hasRole(['user', 'aluno']);
        }
        
        return false;
    }
    
    public function demote(User $currentUser, User $targetUser): bool
    {
        // Não pode rebaixar usuários de nível igual ou superior
        if ($targetUser->hasRole('sysadmin')) {
            return false;
        }
        
        if ($targetUser->hasRole('admin')) {
            return $currentUser->hasRole('sysadmin');
        }
        
        return $this->promote($currentUser, $targetUser, 'user');
    }
}
```

### **Implementação Técnica de Registro:**
```php
<?php
// app/Http/Controllers/Auth/RegisteredUserController.php
public function register(RegisterRequest $request): RedirectResponse
{
    // 1. Validar token do convite
    $invitation = Invitation::where('token', $request->invitation_token)
                           ->where('expires_at', '>', now())
                           ->where('status', 'pending')
                           ->first();
    
    if (!$invitation) {
        return back()->withErrors(['invitation' => 'Convite inválido ou expirado.']);
    }
    
    // 2. Validação específica para convites com email
    if ($invitation->email && $invitation->email !== $request->email) {
        return back()->withErrors([
            'email' => 'O email deve ser: ' . $invitation->email
        ]);
    }
    
    // 3. Criar usuário com papel do convite
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    // 4. Atribuir papel baseado no tipo do convite
    $role = match($invitation->type) {
        InvitationType::ADMIN => 'admin',
        InvitationType::MANAGER => 'manager',
        InvitationType::USER => 'user',
        InvitationType::ALUNO => 'aluno',
    };
    $user->assignRole($role);
    
    // 5. Marcar convite como aceito
    $invitation->update([
        'status' => 'accepted',
        'accepted_at' => now(),
        'accepted_by' => $user->id,
    ]);
    
    // 6. Login automático
    Auth::login($user);
    
    return redirect(RouteRedirectHelper::getRedirectPath($user));
}
```

---

## 📝 **FORMULÁRIOS ESPIRITUAIS**

### **Visão Geral:**
Sistema completo de formulários Livewire que substitui 100% do formulário Excel original, permitindo que usuários registrem informações mediúnicas e trajetória espiritual de forma organizada e interativa.

### **✅ Formulários Implementados (15 Completos):**
1. **Dados Pessoais** - Informações básicas com telefone trabalho
2. **Informações Religiosas** - Trajetória na Umbanda completa  
3. **Formação Sacerdotal** - Estudos de teologia e sacerdócio
4. **Coroações** - Registros de coroações realizadas
5. **Orixás de Cabeça** - Orixás que regem a pessoa (6 posições)
6. **Cruzes de Força** - Cruzes espirituais nas 4 direções
7. **Cruzamentos** - Trabalhos de cruzamento com entidades
8. **Guias de Trabalho** - Guias espirituais por linha
9. **Amacis** - Banhos rituais recebidos com datas
10. **Último Templo** - Informações do templo anterior
11. **Cursos Religiosos** - Cursos espirituais com iniciação
12. **Consagrações de Entidades** - Entidades consagradas
13. **Mistérios Iniciados** - Mistérios com dados padrão (seeders)
14. **Orixás Iniciados** - Orixás nos quais foi iniciado
15. **Magias Divinas** - 8 tipos principais de magia

### **Padrão Arquitetural:**
Todos os formulários seguem o padrão **Livewire Component** com:
- **Model** - Eloquent model para persistência
- **Component** - Livewire component para lógica
- **View** - Blade template para interface
- **Validação** - Rules integradas no component

### **Exemplo de Implementação:**
```php
<?php
// app/Livewire/PersonalDataForm.php
namespace App\Livewire;

class PersonalDataForm extends Component
{
    // Propriedades do formulário
    public $name;
    public $address;
    public $zip_code;
    public $email;
    public $cpf;
    public $rg;
    public $birth_date;
    public $home_phone;
    public $mobile_phone;
    public $work_phone;
    public $emergency_contact;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'zip_code' => 'required|string|max:10',
        'email' => 'required|email|max:255',
        'cpf' => 'required|string|size:11',
        'rg' => 'required|string|max:20',
        'birth_date' => 'required|date',
        'home_phone' => 'nullable|string|max:20',
        'mobile_phone' => 'required|string|max:20',
        'work_phone' => 'nullable|string|max:20',
        'emergency_contact' => 'required|string|max:255',
    ];

    public function mount()
    {
        $data = PersonalData::where('user_id', Auth::id())->first();
        
        if ($data) {
            $this->fill($data->toArray());
        }
    }

    public function save()
    {
        $this->validate();

        PersonalData::updateOrCreate(
            ['user_id' => Auth::id()],
            $this->only([
                'name', 'address', 'zip_code', 'email', 'cpf', 'rg',
                'birth_date', 'home_phone', 'mobile_phone', 'work_phone',
                'emergency_contact'
            ])
        );

        $this->dispatch('show-message', 'Dados pessoais salvos com sucesso!');
    }

    public function render()
    {
        return view('livewire.personal-data-form');
    }
}
```

---

## 🛠️ **SISTEMA CRUD ADMINISTRATIVO**

### **Visão Geral:**
Sistema completo de CRUD administrativo que permite gerenciar as entidades base do sistema espiritual com interface moderna e funcional.

### **🎯 Entidades Gerenciadas:**

#### **1. 📚 Cursos (Courses)**
- **Campos:** name, description, active
- **Relacionamentos:** religiousCourses (cursos feitos pelos usuários)
- **Dados Padrão:** 9 cursos (Teologia e Sacerdócio, Oferendas, Exu do Fogo, etc.)
- **Estatísticas:** Contagem de usuários que fizeram cada curso

#### **2. 🔮 Mistérios (Mysteries)**
- **Campos:** name, description, active  
- **Relacionamentos:** initiatedMysteries (usuários iniciados)
- **Dados Padrão:** 10 mistérios (Brajá do Guardião, Cordões, Toalha Branca, etc.)
- **Estatísticas:** Contagem de iniciações por mistério

#### **3. ⚡ Orixás (Orishas)**
- **Campos:** name, description, active
- **Relacionamentos:** headOrishas, initiatedOrishas (múltiplos relacionamentos)
- **Dados Padrão:** Catálogo completo de Orixás
- **Estatísticas:** Uso em cabeças e iniciações

#### **4. ✨ Tipos de Magia (MagicTypes)**
- **Campos:** name, description, active
- **Relacionamentos:** divineMagics (magias praticadas)
- **Dados Padrão:** 8 tipos principais
- **Estatísticas:** Contagem de usuários por tipo de magia

### **🔧 Funcionalidades por Entidade:**
- **✅ Index** - Listagem com busca, filtros e paginação
- **✅ Create** - Formulário de criação com validação
- **✅ Show** - Visualização detalhada com estatísticas de uso
- **✅ Edit** - Formulário de edição com pré-preenchimento
- **✅ Delete** - Exclusão com confirmação modal

### **📊 Recursos Avançados:**
- **Busca em tempo real** por nome
- **Filtros por status** (ativo/inativo)
- **Paginação automática** (10 itens por página)
- **Estatísticas de uso** (quantos usuários utilizam)
- **Validação robusta** com mensagens em português
- **Interface responsiva** mobile-first
- **Notificações** de sucesso/erro

### **Exemplo de Controller:**
```php
<?php
// app/Http/Controllers/Admin/CourseController.php
namespace App\Http\Controllers\Admin;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        // Busca por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('active', $request->status === 'active');
        }

        $courses = $query->withCount('religiousCourses')
                        ->orderBy('name')
                        ->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso criado com sucesso!');
    }

    public function show(Course $course)
    {
        $course->load('religiousCourses.user');
        $usageStats = [
            'total_users' => $course->religiousCourses_count,
            'recent_registrations' => $course->religiousCourses()
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),
        ];

        return view('admin.courses.show', compact('course', 'usageStats'));
    }
}
```

---

## 🎨 **DESIGN SYSTEM**

### **Identidade Visual:**
O sistema utiliza cores que representam as entidades espirituais da casa:

### **🎨 Paleta de Cores:**
```css
/* Cores Espirituais */
:root {
  /* Oxóssi - Verde da natureza */
  --oxossi-light: #4CAF50;
  --oxossi-default: #2E7D32;
  --oxossi-dark: #1B5E20;
  
  /* Ogum - Vermelho da força */
  --ogum-light: #E53935;
  --ogum-default: #C62828;
  --ogum-dark: #B71C1C;
  
  /* Dourado sagrado */
  --gold-default: #D4AF37;
  --gold-light: #F4D365;
  
  /* Neutros */
  --gray-50: #F9FAFB;
  --gray-100: #F3F4F6;
  --gray-900: #111827;
}
```

### **📝 Tipografia:**
```css
font-family: {
  sans: ['Inter', 'Montserrat', 'sans-serif'], /* Headers */
  body: ['Open Sans', 'Lato', 'sans-serif'],   /* Body text */
}
```

### **🧱 Componentes UI:**

#### **Button Component:**
```php
<!-- resources/views/components/ui/button.blade.php -->
@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
$classes = match($variant) {
    'primary' => 'bg-oxossi-default hover:bg-oxossi-dark text-white',
    'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-900',
    'whatsapp' => 'bg-green-500 hover:bg-green-600 text-white',
    default => 'bg-oxossi-default hover:bg-oxossi-dark text-white',
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
    default => 'px-4 py-2 text-base',
};
@endphp

@if($href)
    <a href="{{ $href }}" 
       class="{{ $classes }} {{ $sizeClasses }} inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-oxossi-default focus:ring-offset-2">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->class([$classes, $sizeClasses, 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-oxossi-default focus:ring-offset-2']) }}>
        {{ $slot }}
    </button>
@endif
```

#### **Card Component:**
```php
<!-- resources/views/components/ui/card.blade.php -->
@props([
    'icon' => null,
    'title' => '',
    'description' => '',
])

<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
    @if($icon)
        <div class="text-oxossi-default mb-4">
            @switch($icon)
                @case('book')
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @break
                @case('heart')
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                    </svg>
                    @break
            @endswitch
        </div>
    @endif
    
    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $description }}</p>
    
    {{ $slot }}
</div>
```

### **📱 Layout Responsivo:**
- **Mobile First:** Design otimizado para dispositivos móveis
- **Breakpoints:** sm (640px), md (768px), lg (1024px), xl (1280px)
- **Grid System:** Tailwind CSS grid com responsividade automática
- **Navigation:** Menu móvel com Alpine.js

---

## 🔧 **PADRÕES DE DESENVOLVIMENTO**

### **Controllers (Magros):**
```php
<?php
// ✅ CORRETO - Controller focado em HTTP
class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}
    
    public function store(UserRequest $request)
    {
        $user = $this->userService->create($request->validated());
        return redirect()->route('users.show', $user);
    }
}
```

### **Services (Lógica de Negócio):**
```php
<?php
// ✅ CORRETO - Service com lógica complexa
class UserService
{
    public function create(array $data): User
    {
        return DB::transaction(function() use ($data) {
            $user = User::create($data);
            $this->assignDefaultRole($user);
            $this->sendWelcomeEmail($user);
            return $user;
        });
    }
    
    private function assignDefaultRole(User $user): void
    {
        $user->assignRole('user');
    }
    
    private function sendWelcomeEmail(User $user): void
    {
        // Lógica de envio de email
    }
}
```

### **Form Requests (Validação):**
```php
<?php
// ✅ CORRETO - Validação centralizada
class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'invitation_token' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço válido.',
            'email.unique' => 'Este email já está sendo usado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não confere.',
        ];
    }
}
```

### **Models com Relacionamentos:**
```php
<?php
// app/Models/User.php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    
    protected $fillable = [
        'name', 'email', 'password', 'is_active'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];
    
    // Relacionamentos
    public function personalData(): HasOne
    {
        return $this->hasOne(PersonalData::class);
    }
    
    public function religiousInfo(): HasOne
    {
        return $this->hasOne(ReligiousInfo::class);
    }
    
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }
    
    // Relacionamentos para Área do Aluno
    public function courseEnrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }
    
    public function activeCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_enrollments')
                    ->wherePivot('status', 'active')
                    ->withPivot(['enrolled_at', 'progress', 'status'])
                    ->withTimestamps();
    }
}
```

### **Enums Modernos:**
```php
<?php
// app/Enums/InvitationType.php
enum InvitationType: string
{
    case ALUNO = 'aluno';
    case USER = 'user';
    case MANAGER = 'manager';
    case ADMIN = 'admin';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::ALUNO => 'Aluno',
            self::USER => 'Usuário',
            self::MANAGER => 'Gerente',
            self::ADMIN => 'Administrador',
        };
    }
    
    public function getDescription(): string
    {
        return match ($this) {
            self::ALUNO => 'Acesso à área educacional (cursos matriculados)',
            self::USER => 'Acesso à área pessoal e formulários espirituais',
            self::MANAGER => 'Acesso gerencial básico (eventos, usuários)',
            self::ADMIN => 'Acesso administrativo completo',
        };
    }
    
    public function getHierarchyLevel(): int
    {
        return match ($this) {
            self::ALUNO => 2,
            self::USER => 3,
            self::MANAGER => 4,
            self::ADMIN => 5,
        };
    }
    
    /**
     * Retorna tipos de convite disponíveis baseado no papel do usuário
     */
    public static function availableForUser(User $user): array
    {
        if ($user->hasRole('sysadmin')) {
            // SysAdmins podem criar qualquer tipo
            return collect(self::cases())
                ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
                ->toArray();
        }
        
        if ($user->hasRole('admin')) {
            // Admins podem criar: aluno, user, manager (mas não admin)
            return [
                self::ALUNO->value => self::ALUNO->getLabel(),
                self::USER->value => self::USER->getLabel(),
                self::MANAGER->value => self::MANAGER->getLabel(),
            ];
        }
        
        if ($user->hasRole('manager')) {
            // Managers podem criar apenas: aluno, user
            return [
                self::ALUNO->value => self::ALUNO->getLabel(),
                self::USER->value => self::USER->getLabel(),
            ];
        }
        
        // Outros não podem criar convites
        return [];
    }
    
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}
```

---

## ⚙️ **CONFIGURAÇÕES TÉCNICAS**

### **🎛️ Feature Flags:**
```php
<?php
// config/features.php
return [
    'invitations' => env('FEATURE_INVITATIONS', true),
    'whatsapp_integration' => env('FEATURE_WHATSAPP', true),
    'admin_dashboard' => env('FEATURE_ADMIN_DASHBOARD', true),
    'sysadmin_panel' => env('FEATURE_SYSADMIN_PANEL', true),
    'spiritual_forms' => env('FEATURE_SPIRITUAL_FORMS', true),
    'crud_admin' => env('FEATURE_CRUD_ADMIN', true),
    'aluno_area_enabled' => env('FEATURE_ALUNO_AREA', true),
];
```

### **📧 Configurações de Email:**
```php
<?php
// config/mail.php
'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'noreply@cacaloo.com'),
    'name' => env('MAIL_FROM_NAME', 'Casa Cacá Loô'),
],

'reply_to' => [
    'address' => env('MAIL_REPLY_TO_ADDRESS', null),
    'name' => env('MAIL_REPLY_TO_NAME', null),
],
```

### **🔐 Spatie Permission:**
```php
<?php
// config/permission.php
return [
    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],
    
    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_permissions' => 'model_has_permissions',
        'model_has_roles' => 'model_has_roles',
        'role_has_permissions' => 'role_has_permissions',
    ],
    
    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'default',
    ],
];
```

### **🎯 Configuração da Casa:**
```php
<?php
// config/centro.php
return [
    'name' => env('CENTRO_NAME', 'Casa de Caridade Legião de Oxóssi e Ogum'),
    'short_name' => env('CENTRO_SHORT_NAME', 'Casa Cacá Loô'),
    'address' => env('CENTRO_ADDRESS', 'Endereço da Casa'),
    'phone' => env('CENTRO_PHONE', '(11) 99999-9999'),
    'email' => env('CENTRO_EMAIL', 'contato@cacaloo.com'),
    'whatsapp' => env('CENTRO_WHATSAPP', '5511999999999'),
    'social' => [
        'facebook' => env('CENTRO_FACEBOOK', '#'),
        'instagram' => env('CENTRO_INSTAGRAM', '#'),
        'youtube' => env('CENTRO_YOUTUBE', '#'),
    ],
];
```

### **🛡️ Middleware de Proteção:**
```php
<?php
// app/Http/Middleware/AdminAccess.php
class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->hasRole(['admin', 'sysadmin'])) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Acesso não autorizado à área administrativa.');
        }
        
        return $next($request);
    }
}

// app/Http/Middleware/UserAccess.php
class UserAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Bloquear alunos de acessar área user
        if (Auth::user()->hasRole('aluno') && !Auth::user()->hasRole(['user', 'admin', 'sysadmin'])) {
            return redirect()
                ->route('aluno.dashboard')
                ->with('error', 'Alunos devem usar a área educacional.');
        }
        
        if (!Auth::user()->hasRole(['user', 'admin', 'sysadmin'])) {
            return redirect()
                ->route('home')
                ->with('error', 'Acesso não autorizado à área de usuários.');
        }
        
        return $next($request);
    }
}

// app/Http/Middleware/RedirectBasedOnRole.php
class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Redirecionar baseado na hierarquia mais alta
            if ($user->hasRole('sysadmin')) {
                return redirect()->route('sysadmin.dashboard');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('manager')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('portal.dashboard');
            } elseif ($user->hasRole('aluno')) {
                // Verificar se área do aluno está habilitada
                if (config('features.aluno_area_enabled', true)) {
                    return redirect()->route('aluno.dashboard');
                } else {
                    // Se área do aluno está desabilitada, redirecionar para home
                    return redirect()
                        ->route('home')
                        ->with('info', 'A área educacional está temporariamente indisponível.');
                }
            }
        }
        
        return $next($request);
    }
}

// app/Http/Middleware/ManagerCRUDRestriction.php
class ManagerCRUDRestriction
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        // SysAdmin e Admin têm acesso total
        if ($user->hasRole(['sysadmin', 'admin'])) {
            return $next($request);
        }
        
        // Manager só pode fazer operações de leitura
        if ($user->hasRole('manager')) {
            $method = $request->method();
            $route = $request->route()->getName();
            
            // Verificar se é operação CRUD restrita
            if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                // Verificar se é rota de usuários ou alunos
                if (str_contains($route, 'users') || str_contains($route, 'personal-data')) {
                    return redirect()
                        ->back()
                        ->with('error', 'Managers não têm permissão para editar dados de usuários.');
                }
            }
        }
        
        return $next($request);
    }
}
```

### **🎯 Gates de Autorização:**
```php
<?php
// app/Providers/AppServiceProvider.php
public function boot()
{
    // Gate que permite sysadmin fazer tudo
    Gate::before(function ($user, $ability) {
        return $user->hasRole('sysadmin') ? true : null;
    });
    
    // Gates específicos para funcionalidades
    Gate::define('invite-users', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('manage-invitations', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('whatsapp-integration', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']) && 
               app(FeatureService::class)->isEnabled('whatsapp_integration');
    });
    
    Gate::define('manage-features', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('access-aluno-area', function ($user) {
        return $user->hasRole('aluno') && 
               config('features.aluno_area_enabled', true);
    });
    
    Gate::define('create-admin-invitation', function ($user) {
        return $user->hasRole('sysadmin');
    });
    
    Gate::define('promote-to-admin', function ($user) {
        return $user->hasRole('sysadmin');
    });
    
    Gate::define('manage-user-roles', function ($user, $targetUser = null) {
        if ($user->hasRole('sysadmin')) {
            return true;
        }
        
        if ($user->hasRole('admin') && $targetUser) {
            // Admin não pode promover para admin ou afetar outros admins/sysadmins
            return !$targetUser->hasRole(['admin', 'sysadmin']);
        }
        
        if ($user->hasRole('manager') && $targetUser) {
            // Manager só pode gerenciar users e alunos
            return $targetUser->hasRole(['user', 'aluno']);
        }
        
        return false;
    });
    
    Gate::define('crud-users', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('view-users', function ($user) {
        return $user->hasRole(['admin', 'manager', 'sysadmin']);
    });
    
    Gate::define('create-users', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('edit-users', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
    
    Gate::define('delete-users', function ($user) {
        return $user->hasRole(['admin', 'sysadmin']);
    });
}
```

---

## 🚀 **COMANDOS ÚTEIS**

### **🏗️ Setup Inicial:**
```bash
# Instalar dependências
composer install
npm install

# Configurar ambiente
cp .env.example .env
php artisan key:generate

# Configurar banco de dados
php artisan migrate

# Executar seeders
php artisan db:seed

# Build assets
npm run build
```

### **👥 Gestão de Usuários:**
```bash
# Criar usuário sysadmin
php artisan make:command CreateSysAdmin
php artisan app:create-sysadmin

# Criar convite via Artisan
php artisan make:command CreateInvitation
php artisan app:create-invitation email@example.com admin

# Listar convites pendentes
php artisan app:list-invitations --pending
```

### **🔧 Feature Flags:**
```bash
# Verificar status de features
php artisan tinker
>>> config('features.aluno_area_enabled');
>>> app(FeatureService::class)->isEnabled('invitations');

# Alternar feature via comando
php artisan app:toggle-feature invitations
php artisan app:toggle-feature aluno_area_enabled

# Desabilitar área do aluno via .env
# Adicionar no arquivo .env:
FEATURE_ALUNO_AREA=false
```

### **🐳 Docker:**
```bash
# Subir ambiente completo
docker-compose up -d

# Executar comandos no container
docker-compose exec app php artisan migrate

# Logs do container
docker-compose logs -f app
```

---

## 📊 **RESUMO TÉCNICO**

### **✅ Funcionalidades Implementadas:**
- ✅ **Sistema de autenticação** completo com 6 níveis de acesso
- ✅ **Sistema de convites** (específicos e anônimos) com WhatsApp
- ✅ **15 formulários espirituais** Livewire substituindo Excel 100%
- ✅ **CRUD administrativo** para 4 entidades principais
- ✅ **Feature flags** para controle dinâmico
- ✅ **Design system** consistente com identidade espiritual
- ✅ **Validação localizada** em português
- ✅ **Interface responsiva** mobile-first
- ✅ **Proteção de rotas** com middleware e gates

### **🎯 Arquitetura Consolidada:**
- **Clean Architecture** com separação clara de responsabilidades
- **SOLID principles** aplicados consistentemente
- **PHP 8.4+** com features modernas (enums, match, readonly)
- **Laravel 12+** com melhores práticas
- **Livewire 3.x** para interatividade sem JavaScript complexo
- **Tailwind CSS** para design system escalável
- **Docker** para ambiente de desenvolvimento padronizado

### **🔒 Segurança Implementada:**
- **Tokens UUID** únicos e seguros para convites
- **Validação robusta** em todas as camadas (Request → Service → Model)
- **Middleware de proteção** nas rotas críticas
- **Autorização granular** por papéis e gates
- **Sanitização de dados** para integração WhatsApp
- **CSRF protection** nativo do Laravel
- **Password hashing** com bcrypt

O sistema está **completo e em produção**, oferecendo uma solução robusta para gestão espiritual com múltiplos canais de convite, formulários interativos e controle administrativo avançado.
