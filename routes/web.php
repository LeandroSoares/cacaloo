<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeCustomizationController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rota de teste para envio de email
Route::get('/test-email', function () {
    Mail::to('test@example.com')->send(new TestEmail());
    return 'Email enviado com sucesso! Verifique o MailHog em: <a href="http://localhost:8025" target="_blank">http://localhost:8025</a>';
});

// Rota temporária para verificar papéis e permissões
Route::get('/check-roles-permissions', function () {
    $roles = \Spatie\Permission\Models\Role::all();
    $permissions = \Spatie\Permission\Models\Permission::all();

    $roleData = $roles->map(function ($role) {
        return [
            'name' => $role->name,
            'permissions' => $role->permissions->pluck('name'),
        ];
    });

    return [
        'roles' => $roleData,
        'permissions' => $permissions->pluck('name'),
    ];
});

// Área do Usuário (comum)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/meus-dados', function () {
        return view('user.meus-dados');
    })->name('user.meus-dados');

    Route::get('/historico-mediunico', [\App\Http\Controllers\MediumHistoryController::class, 'show'])
        ->name('user.medium-history');
    // Adicione aqui outras rotas para a área do usuário comum
});

// Rotas Administrativas
Route::middleware(['auth', \App\Http\Middleware\AdminAccess::class])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gerenciamento de Usuários
    Route::resource('users', UserController::class);

    // Gerenciamento de Papéis
    Route::resource('roles', RoleController::class);

    // Gerenciamento de Convites
    Route::resource('invitations', InvitationController::class)->except(['edit', 'update', 'show']);
    Route::post('invitations/{invitation}/resend', [InvitationController::class, 'resend'])->name('invitations.resend');
    Route::patch('invitations/{invitation}/cancel', [InvitationController::class, 'cancel'])->name('invitations.cancel');

    // Customização da Homepage
    Route::get('home-customization', [HomeCustomizationController::class, 'index'])->name('home-customization.index');
    Route::post('home-customization', [HomeCustomizationController::class, 'store'])->name('home-customization.store');

    // Adicione aqui outras rotas administrativas
});


// Rotas SysAdmin - Super Administrador
Route::middleware(['auth', \App\Http\Middleware\SysAdminAccess::class])->prefix('sysadmin')->name('sysadmin.')->group(function () {
    // Dashboard SysAdmin
    Route::get('/dashboard', function () {
        return view('sysadmin.dashboard');
    })->name('dashboard');

    // Gerenciamento de Permissões
    Route::resource('permissions', PermissionController::class);

    // Logs do Sistema
    Route::get('/system/logs', function () {
        if (request()->has('download')) {
            $logPath = storage_path('logs/laravel.log');
            if (file_exists($logPath)) {
                return response()->download($logPath, 'laravel-log-'.date('Y-m-d').'.log');
            }
            return back()->with('error', 'Arquivo de log não encontrado.');
        }
        return view('sysadmin.system.logs');
    })->name('system.logs');

    // Gerenciamento de Papéis e Permissões
    Route::resource('roles', RoleController::class);

    // Adicione aqui outras rotas de sysadmin
});

require __DIR__.'/auth.php';
