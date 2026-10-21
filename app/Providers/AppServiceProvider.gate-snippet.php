<?php
// Adicione dentro do método boot() de App\Providers\AppServiceProvider.
// ADAPTE ao modelo real de permissões antes de produção.
use Illuminate\Support\Facades\Gate;
// Dentro de boot():
Gate::define('manage-casa-arquivos', function ($user): bool {
    return in_array($user->role ?? null, ['admin','administrador','responsavel'], true);
    // Spatie Permission: return $user->hasAnyRole(['admin','administrador','responsavel']);
});
