<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeCustomizationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de desenvolvimento (apenas local)
if (app()->environment('local')) {
    // Rota de teste para envio de email
    Route::get('/test-email', [\App\Http\Controllers\DebugController::class, 'testEmail']);

    // Rota de debug para verificar papéis e permissões
    Route::get('/check-roles-permissions', [\App\Http\Controllers\DebugController::class, 'checkRolesPermissions']);
}

// Área do Usuário (comum)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/meus-dados', 'user.meus-dados')->name('user.meus-dados');
    Route::view('/guias', 'user.static-pages.guias')->name('user.guias');
    Route::view('/lendas-orixas', 'user.static-pages.lendas-orixas')->name('user.lendas-orixas');
    Route::view('/lendas', 'user.static-pages.lendas')->name('user.lendas');
    Route::view('/orientacoes-casa', 'user.static-pages.orientacoes-casa')->name('user.orientacoes-casa');
    Route::view('/orientacoes-mediuns', 'user.static-pages.orientacoes-mediuns')->name('user.orientacoes-mediuns');
    Route::get('/orixas', [\App\Http\Controllers\User\StaticPageController::class, 'orixas'])->name('user.orixas');

    Route::get('/historico-mediunico', [\App\Http\Controllers\MediumHistoryController::class, 'show'])
        ->name('user.medium-history');
    // Adicione aqui outras rotas para a área do usuário comum
});

// Biblioteca de Arquivos (acessível a todos os usuários autenticados)
Route::middleware('auth')->group(function () {
    Route::redirect('/arquivos-diversos', '/biblioteca', 301)->name('user.arquivos-diversos');

    Route::prefix('biblioteca')->name('user.library.')->controller(\App\Http\Controllers\User\LibraryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{libraryFile}/download', 'download')->name('download');
        Route::get('/{libraryFile}/capa', 'cover')->name('cover');
    });
});

// Rotas Administrativas
Route::middleware(['auth', \App\Http\Middleware\AdminAccess::class])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Gerenciamento de Usuários
    Route::resource('users', UserController::class);

    // Gerenciamento de Convites
    Route::resource('invitations', InvitationController::class)->except(['edit', 'update']);
    Route::post('invitations/{invitation}/resend', [InvitationController::class, 'resend'])->name('invitations.resend');
    Route::patch('invitations/{invitation}/cancel', [InvitationController::class, 'cancel'])->name('invitations.cancel');

    // Eventos
    Route::resource('events', EventController::class);

    // Customização da Homepage
    Route::get('home-customization', [HomeCustomizationController::class, 'index'])->name('home-customization.index');
    Route::post('home-customization', [HomeCustomizationController::class, 'store'])->name('home-customization.store');

    // Gerenciamento de Entidades do Sistema
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
    Route::resource('mysteries', \App\Http\Controllers\Admin\MysteryController::class);
    Route::resource('orishas', \App\Http\Controllers\Admin\OrishaController::class);
    Route::resource('magic-types', \App\Http\Controllers\Admin\MagicTypeController::class);

    // Mensagens do Dia
    Route::resource('daily-messages', \App\Http\Controllers\Admin\DailyMessageController::class);
    Route::patch('daily-messages/{dailyMessage}/toggle-active', [\App\Http\Controllers\Admin\DailyMessageController::class, 'toggleActive'])->name('daily-messages.toggle-active');
    Route::post('daily-messages-cache/clear', [\App\Http\Controllers\Admin\DailyMessageController::class, 'clearCache'])->name('daily-messages.clear-cache');

    // Gerenciador de Conteúdos (CMS)
    Route::resource('contents', \App\Http\Controllers\Admin\ContentController::class);

    // Biblioteca de Arquivos
    Route::middleware('can:library.manage')->group(function () {
        Route::resource('library', \App\Http\Controllers\Admin\LibraryFileController::class);
        Route::patch('library/{library}/toggle-active', [\App\Http\Controllers\Admin\LibraryFileController::class, 'toggleActive'])
            ->name('library.toggle-active');
        Route::get('library/{library}/download', [\App\Http\Controllers\Admin\LibraryFileController::class, 'download'])
            ->name('library.download');
        Route::get('library/{library}/cover', [\App\Http\Controllers\Admin\LibraryFileController::class, 'cover'])
            ->name('library.cover');
    });

    // Adicione aqui outras rotas administrativas
});

// Rotas SysAdmin - Super Administrador
Route::middleware(['auth', \App\Http\Middleware\SysAdminAccess::class])->prefix('sysadmin')->name('sysadmin.')->group(function () {
    // Dashboard SysAdmin
    Route::get('/dashboard', [\App\Http\Controllers\SysAdmin\DashboardController::class, 'index'])->name('dashboard');

    // Gerenciamento de Permissões
    Route::resource('permissions', PermissionController::class);

    // Logs do Sistema
    Route::get('/system/logs', [\App\Http\Controllers\SysAdmin\DashboardController::class, 'logs'])->name('system.logs');

    // Gerenciamento de Papéis e Permissões
    Route::resource('roles', RoleController::class);

    // Adicione aqui outras rotas de sysadmin
});

// Rotas de Conteúdo (CMS)
// Privado (Portal)
Route::get('/portal/artigos', [\App\Http\Controllers\ContentController::class, 'portalIndex'])
    ->name('portal.articles')
    ->middleware('auth');

Route::get('/portal/{slug}', [\App\Http\Controllers\ContentController::class, 'showPrivate'])
    ->name('portal.content')
    ->where('slug', '[a-z0-9\-]+');

// Público (Prefixo /c/ para evitar conflitos com rotas de sistema como /login)
Route::get('/c/{slug}', [\App\Http\Controllers\ContentController::class, 'showPublic'])
    ->name('public.content')
    ->where('slug', '[a-z0-9\-]+');

require __DIR__.'/auth.php';
