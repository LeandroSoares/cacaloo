<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DebugController extends Controller
{
    public function testEmail()
    {
        Mail::to('test@example.com')->send(new TestEmail);

        return 'Email enviado com sucesso! Verifique o MailHog em: <a href="http://localhost:8025" target="_blank">http://localhost:8025</a>';
    }

    public function checkRolesPermissions()
    {
        $roles = Role::all();
        $permissions = Permission::all();

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
    }
}
