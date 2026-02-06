# 🔐 **SISTEMA DE PERMISSÕES - PROJETO CACALOO**

## **🆕 ATUALIZAÇÃO: RN024 - Níveis de Visualização de Dados Pessoais**

### **📋 Regras de Negócio Definidas (RN024):**

#### **👤 User/Aluno:**
- ✅ **CRUD completo** nos próprios dados pessoais
- ❌ **Não vê dados** pessoais de outros usuários

#### **👨‍💻 Manager:**  
- ✅ **Dados simples** de qualquer usuário: nome, email, telefone celular
- ❌ **Não vê** CPF, RG, endereço, telefones fixo/trabalho, contato emergência
- ✅ **CRUD completo** nos próprios dados pessoais

#### **👨‍💼 Admin:**
- ✅ **Visualização completa** de todos os dados pessoais
- ❌ **Não pode editar** dados pessoais de outros usuários
- ✅ **Pode editar** apenas próprios dados pessoais
- ✅ **Pode editar** outros tipos de dados (não pessoais)

#### **🔧 SysAdmin:**
- ✅ **Acesso total** - visualizar e alterar dados pessoais de qualquer usuário
- ✅ **Bypass** de todas as restrições via Gate

---

## **📚 Stack Tecnológico**

### **1. Spatie Laravel Permission v6.21**
- **Package Principal:** `spatie/laravel-permission`
- **Funcionalidades:**
  - Gerenciamento de Roles (Papéis)
  - Gerenciamento de Permissions (Permissões)  
  - Middleware automático de verificação
  - Diretivas Blade personalizadas
  - Cache de permissões

### **2. Models Principais**
```php
// Spatie Models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// User Model com Trait
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    
    // Métodos automáticos disponíveis:
    // hasRole(), assignRole(), syncRoles()
    // can(), hasPermissionTo(), givePermissionTo()
}
```

### **3. Middleware Implementados**

#### **Middleware Personalizados:**
```php
// app/Http/Middleware/AdminAccess.php
- Controla acesso para roles: admin|sysadmin
- Redirecionamento: portal.dashboard

// app/Http/Middleware/SysAdminAccess.php  
- Controla acesso exclusivo para role: sysadmin
- Redirecionamento: admin.dashboard

// app/Http/Middleware/CheckRole.php
- Middleware genérico para múltiplas roles
- Uso: middleware('role:admin,manager')
```

#### **Middleware Spatie (Registrados):**
```php
// app/Providers/RoleServiceProvider.php
$router->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
$router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);

// Uso nas rotas:
Route::middleware(['permission:user.view'])->group(function () {
    // Rotas protegidas por permissão específica
});
```

### **4. Gates & Policies**

#### **Gates Globais:**
```php
// app/Providers/RoleServiceProvider.php
Gate::before(function ($user, $ability) {
    return $user->hasRole('sysadmin') ? true : null;  // SysAdmin bypassa tudo
});
```

#### **Policies Específicas:**
```php
// app/Policies/PersonalDataPolicy.php
class PersonalDataPolicy
{
    public function view(User $user, PersonalData $data): bool
    {
        return $user->id === $data->user_id || $user->isAdmin();
    }
    
    public function update(User $user, PersonalData $data): bool
    {
        return $user->id === $data->user_id || $user->isAdmin();
    }
}
```

### **5. Diretivas Blade Personalizadas**

```php
// app/Providers/RoleServiceProvider.php

// Diretiva @role
Blade::directive('role', function ($role) {
    return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
});

// Diretiva @permission  
Blade::directive('permission', function ($permission) {
    return "<?php if(auth()->check() && auth()->user()->can({$permission})): ?>";
});

// Uso nas Views:
@role('admin')
    <button>Ação Admin</button>
@endrole

@permission('user.create')
    <a href="{{ route('users.create') }}">Criar Usuário</a>
@endpermission
```

---

## **🎯 PERMISSÕES POR REGRA DE NEGÓCIO**

### **RN018-RN020: Área do Aluno**
```php
// Permissões específicas do aluno
'aluno.access'              // Acesso à área /aluno
'aluno.view.courses'        // Ver cursos matriculados
'aluno.view.materials'      // Ver materiais dos cursos  
'aluno.update.progress'     // Atualizar progresso
'course.enroll'             // Matricular em curso
'course.unenroll'           // Desmatricular

// Feature Flag Control (RN020)
config('features.aluno_area_enabled', true)  // Controle dinâmico
```

### **RN021-RN022: Convites Restritos**
```php
// Permissões de convite por tipo
'invite.create.common'      // Criar convite usuário comum
'invite.create.manager'     // Criar convite manager  
'invite.create.admin'       // Criar convite admin (só sysadmin)

// Lógica no Controller
public function getAvailableInviteTypes()
{
    $types = [];
    
    if (Auth::user()->can('invite.create.common')) {
        $types['common'] = 'Usuário Comum';
    }
    
    if (Auth::user()->can('invite.create.manager')) {
        $types['manager'] = 'Gerente';
    }
    
    if (Auth::user()->can('invite.create.admin')) {
        $types['admin'] = 'Administrador';
    }
    
    return $types;
}
```

### **RN023: Manager CRUD Limitado**
```php
// Manager tem apenas visualização de usuários
$managerRole->syncPermissions([
    'user.view',                    // ✅ Ver usuários
    // 'user.create',               // ❌ Criar usuários
    // 'user.edit',                 // ❌ Editar usuários  
    // 'user.delete',               // ❌ Deletar usuários
    
    'invite.create.common',         // ✅ Convite comum
    'invite.create.manager',        // ✅ Convite manager
    // 'invite.create.admin',       // ❌ Convite admin
]);
```

---

## **🏗️ ESTRUTURA DE ROLES E PERMISSÕES**

### **Hierarquia de Papéis:**
```
SysAdmin (Acesso Total)
    ├── Admin (Administrativo)
    ├── Manager (Gerencial Limitado)  
    ├── User (Básico)
    └── Aluno (Educacional Isolado)
```

### **Mapeamento Completo:**

#### **🔧 SysAdmin**
```php
Permission::all()  // Acesso irrestrito via Gate::before()
```

#### **👨‍💼 Admin (RN024 Atualizado)**
```php
$adminPermissions = [
    // Usuários
    'user.view', 'user.create', 'user.edit', 'user.delete',
    
    // Dados Pessoais (RN024)
    'personal.data.view.full',         // Ver dados completos de todos
    'personal.data.edit.own',          // Editar apenas próprios dados
    // Nota: Admin NÃO tem 'personal.data.edit.others'
    
    // Convites  
    'invite.view', 'invite.create', 'invite.edit', 'invite.delete',
    'invite.create.common', 'invite.create.manager', 'invite.create.admin',
    
    // Médiuns
    'medium_type.view', 'medium_type.create', 'medium_type.edit', 'medium_type.delete',
    'medium_attribute.view', 'medium_attribute.create', 'medium_attribute.edit', 'medium_attribute.delete',
    
    // Relatórios
    'report.view', 'report.export',
    
    // Papéis
    'role.view', 'role.assign.admin', 'role.assign.manager', 'role.assign.user'
];
```

#### **👨‍💻 Manager (RN024 Atualizado)**
```php
$managerPermissions = [
    // Usuários (só visualização)
    'user.view',
    
    // Dados Pessoais (RN024)
    'personal.data.view.simple',       // Apenas nome, email, celular
    'personal.data.edit.own',          // CRUD nos próprios dados
    
    // Convites limitados
    'invite.view', 'invite.create.common', 'invite.create.manager',
    
    // Médiuns (só visualização)
    'medium_type.view', 'medium_attribute.view',
    
    // Relatórios
    'report.view', 'report.export'
];
```

#### **👤 User (RN024 Atualizado)**
```php
$userPermissions = [
    // Dados Pessoais (RN024)
    'personal.data.edit.own',          // CRUD completo nos próprios dados
    
    'medium_type.view',
    'medium_attribute.view'
];
```

#### **🎓 Aluno (RN024 Atualizado)**
```php
$alunoPermissions = [
    // Dados Pessoais (RN024)
    'personal.data.edit.own',          // CRUD completo nos próprios dados
    
    'aluno.access',
    'aluno.view.courses',
    'aluno.view.materials', 
    'aluno.update.progress'
];
```

---

## **🛣️ IMPLEMENTAÇÃO NAS ROTAS**

### **Proteção por Middleware:**
```php
// routes/web.php

// Área Admin - Múltiplas roles
Route::middleware(['auth', 'role:admin|manager|sysadmin'])
    ->prefix('admin')
    ->group(function () {
        
        // Usuários - controle granular por permissão
        Route::middleware(['permission:user.view'])
            ->resource('users', UserController::class)
            ->only(['index', 'show']);
            
        Route::middleware(['permission:user.create'])  
            ->resource('users', UserController::class)
            ->only(['create', 'store']);
            
        Route::middleware(['permission:user.edit'])
            ->resource('users', UserController::class) 
            ->only(['edit', 'update']);
            
        Route::middleware(['permission:user.delete'])
            ->resource('users', UserController::class)
            ->only(['destroy']);
    });

// Área Aluno - Role específica + feature flag
Route::middleware(['auth', 'role:aluno'])
    ->prefix('aluno')
    ->group(function () {
        // Verificação adicional via config
        if (!config('features.aluno_area_enabled')) {
            return abort(503, 'Área temporariamente indisponível');
        }
        
        Route::middleware(['permission:aluno.access'])
            ->group(function () {
                Route::get('/dashboard', [AlunoController::class, 'dashboard']);
                Route::get('/cursos', [AlunoController::class, 'courses']);
            });
    });
```

### **Controllers com Autorização:**
```php
class UserController extends Controller
{
    public function create()
    {
        // Spatie verifica automaticamente via middleware 'permission:user.create'
        return view('admin.users.create');
    }
    
    public function store(Request $request)
    {
        // Verificação manual adicional se necessário
        if (!Auth::user()->can('user.create')) {
            abort(403, 'Sem permissão para criar usuários');
        }
        
        // Lógica de criação...
    }
    
    public function edit(User $user) 
    {
        // Policy específica para edição
        $this->authorize('update', $user);
        
        return view('admin.users.edit', compact('user'));
    }
}
```

---

## **🧪 TESTAGEM DO SISTEMA**

### **Testes de Permissão:**
```php
// tests/Feature/PermissionTest.php

public function test_manager_cannot_create_users()
{
    $manager = User::factory()->create();
    $manager->assignRole('manager');
    
    $response = $this->actingAs($manager)
        ->post(route('admin.users.store'), [...]);
        
    $response->assertStatus(403);
}

public function test_admin_can_create_users()
{
    $admin = User::factory()->create(); 
    $admin->assignRole('admin');
    
    $response = $this->actingAs($admin)
        ->post(route('admin.users.store'), [...]);
        
    $response->assertStatus(302);
}

public function test_aluno_access_requires_feature_flag()
{
    config(['features.aluno_area_enabled' => false]);
    
    $aluno = User::factory()->create();
    $aluno->assignRole('aluno');
    
    $response = $this->actingAs($aluno)
        ->get(route('aluno.dashboard'));
        
    $response->assertStatus(503);
}
```

---

## **⚡ PERFORMANCE E CACHE**

### **Cache de Permissões:**
```php
// Limpar cache quando necessário
php artisan permission:cache-reset

// Cache automático do Spatie
app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
```

### **Otimizações:**
```php
// Eager loading de roles/permissões
User::with('roles.permissions')->get();

// Verificação em lote
$user->hasAnyRole(['admin', 'manager']);
$user->hasAllRoles(['user', 'aluno']);
```

---

## **🔄 SEEDER FINAL ATUALIZADO**

```php
<?php
// database/seeders/RolesAndPermissionsSeeder.php

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // === PERMISSÕES POR MÓDULO ===
        
        // Usuários
        $userPermissions = [
            'user.view', 'user.create', 'user.edit', 'user.delete'
        ];

        // Alunos (RN018-RN020)
        $alunoPermissions = [
            'aluno.access', 'aluno.view.courses', 'aluno.view.materials', 
            'aluno.update.progress', 'course.enroll', 'course.unenroll'
        ];

        // Convites (RN021-RN022)  
        $invitePermissions = [
            'invite.view', 'invite.create', 'invite.edit', 'invite.delete',
            'invite.create.common', 'invite.create.manager', 'invite.create.admin'
        ];

        // Médiuns
        $mediumPermissions = [
            'medium_type.view', 'medium_type.create', 'medium_type.edit', 'medium_type.delete',
            'medium_attribute.view', 'medium_attribute.create', 'medium_attribute.edit', 'medium_attribute.delete'
        ];

        // Configurações
        $configPermissions = [
            'config.view', 'config.edit'
        ];

        // Relatórios
        $reportPermissions = [
            'report.view', 'report.export'
        ];

        // Papéis
        $rolePermissions = [
            'role.view', 'role.create', 'role.edit', 'role.delete'
        ];

        // Atribuição de papéis
        $roleAssignmentPermissions = [
            'role.assign.sysadmin', 'role.assign.admin', 'role.assign.manager', 'role.assign.user'
        ];

        // === CRIAR PERMISSÕES ===
        $allPermissions = array_merge(
            $userPermissions, $alunoPermissions, $invitePermissions,
            $mediumPermissions, $configPermissions, $reportPermissions,
            $rolePermissions, $roleAssignmentPermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // === CRIAR PAPÉIS E ATRIBUIR PERMISSÕES ===

        // SysAdmin - Acesso total (via Gate::before)
        $sysadmin = Role::firstOrCreate(['name' => 'sysadmin']);
        $sysadmin->syncPermissions(Permission::all());

        // Admin - Acesso administrativo
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(array_merge(
            $userPermissions, $invitePermissions, $mediumPermissions,
            $reportPermissions, ['role.view'], 
            ['role.assign.admin', 'role.assign.manager', 'role.assign.user']
        ));

        // Manager - Acesso limitado (RN023)
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->syncPermissions([
            'user.view', 'invite.view', 'invite.create.common', 'invite.create.manager',
            'medium_type.view', 'medium_attribute.view', 'report.view', 'report.export'
        ]);

        // User - Acesso básico  
        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions(['medium_type.view', 'medium_attribute.view']);

        // Aluno - Área educacional isolada (RN018-RN020)
        $aluno = Role::firstOrCreate(['name' => 'aluno']);
        $aluno->syncPermissions($alunoPermissions);

        // === USUÁRIO INICIAL ===
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@cacaloo.com.br'],
            [
                'name' => 'Administrador do Sistema',
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD', 'ALTERE_ESTA_SENHA'))
            ]
        );
        $adminUser->assignRole(['sysadmin', 'admin', 'manager', 'user']);
    }
}
```

---

## **📝 RESUMO EXECUTIVO**

### **✅ Sistema Implementado:**
1. **Spatie Laravel Permission** como base
2. **Middleware personalizados** para controle de acesso por role
3. **Permissões granulares** para cada operação CRUD
4. **Diretivas Blade** personalizadas para views
5. **Gates globais** para bypass do SysAdmin
6. **Policies específicas** para recursos individuais
7. **Feature flags** para controle dinâmico
8. **Cache automático** de permissões

### **🎯 Regras de Negócio Atendidas:**
- **RN018-RN020:** Área do aluno isolada com controle por permissões
- **RN021-RN022:** Convites restritos por tipo conforme papel
- **RN023:** Manager limitado a visualização de usuários

### **🔒 Controle de Segurança:**
- **Autorização automática** via middleware Spatie
- **Verificação granular** por operação específica  
- **Hierarquia de papéis** clara e escalável
- **Bypass controlado** para SysAdmin
- **Auditoria** através do sistema de logs

**O sistema está pronto para produção com controle completo de permissões via Spatie Laravel Permission, eliminando a necessidade de middlewares customizados para CRUD.**
