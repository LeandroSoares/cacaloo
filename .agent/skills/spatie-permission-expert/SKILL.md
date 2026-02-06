---
name: spatie-permission-expert
description: Expert guide for managing roles and permissions with Spatie Laravel Permission.
---

# Spatie Permission Expert Skill

## 1. Roles vs Permissions
**Prefer Permissions over Roles** for code checks.
- Roles are groups of permissions.
- Code should check "can user do X?" (Permission), not "is user a Y?" (Role), except for high-level dashboard access.

```php
// ✅ DO THIS
if ($user->can('edit articles')) { ... }

// ⚠️ AVOID THIS (unless specific logic requires it)
if ($user->hasRole('editor')) { ... }
```

## 2. Middleware
Protect routes using the `permission` middleware (or `role` if strictly necessary).

```php
Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
    // ...
});
```

## 3. Blade Directives
Use blade directives to hide UI elements.

```blade
@can('edit articles')
    <button>Edit</button>
@endcan

@role('super-admin')
    <button>Nuke Database</button>
@endrole
```

## 4. Super Admin Bypass
Always implement a Gate::before check for Super Admins to bypass checks.
*(This should be in `AppServiceProvider` or `AuthServiceProvider`)*

```php
Gate::before(function ($user, $ability) {
    return $user->hasRole('Super Admin') ? true : null;
});
```

## 5. Performance
The library caches permissions.
- **Reset Cache**: When changing permissions in seeders/migrations, always run:
  `app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();`
