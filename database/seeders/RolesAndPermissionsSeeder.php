<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões por módulo

        // Permissões de usuários
        $userPermissions = [
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
        ];

                // Permissões de convites
        $invitePermissions = [
            'invite.view',
            'invite.create',
            'invite.edit',
            'invite.delete',
        ];

        // Permissões de médiuns (considerando como tipo de usuário)
        $mediumTypePermissions = [
            'medium_type.view',
            'medium_type.create',
            'medium_type.edit',
            'medium_type.delete',
            'medium_attribute.view',
            'medium_attribute.create',
            'medium_attribute.edit',
            'medium_attribute.delete',
        ];

        // Permissões de configurações
        $configPermissions = [
            'config.view',
            'config.edit',
        ];

        // Permissões de relatórios
        $reportPermissions = [
            'report.view',
            'report.export',
        ];

        // Permissões de gerenciamento de papéis
        $rolePermissions = [
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
        ];

                // Permissões de atribuição de papéis
        $roleAssignmentPermissions = [
            'role.assign.sysadmin', // Apenas sysadmin pode atribuir papel de sysadmin
            'role.assign.admin',
            'role.assign.manager',
            'role.assign.user',
        ];

        // Criar todas as permissões
        $allPermissions = array_merge(
            $userPermissions,
            $invitePermissions,
            $mediumTypePermissions,
            $configPermissions,
            $reportPermissions,
            $rolePermissions,
            $roleAssignmentPermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Criar papéis e atribuir permissões

        // Papel Sysadmin - acesso total
        $sysadminRole = Role::create(['name' => 'sysadmin']);
        $sysadminRole->givePermissionTo(Permission::all());

        // Papel Admin - acesso administrativo sem configurações técnicas
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(array_merge(
            $userPermissions,
            $invitePermissions,
            $mediumTypePermissions,
            $reportPermissions,
            ['role.view'],
            [
                'role.assign.admin',
                'role.assign.manager',
                'role.assign.user'
            ]
        ));

        // Papel Manager - acesso gerencial
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'user.view',
            'invite.view',
            'invite.create',
            'medium_type.view',
            'medium_attribute.view',
            'report.view',
            'report.export',
        ]);

        // Papel User - acesso básico
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'medium_type.view',
            'medium_attribute.view',
        ]);

        // Criar um usuário Sysadmin inicial
        $sysadmin = User::create([
            'name' => 'Administrador do Sistema',
            'email' => 'admin@cacaloo.com.br',
            'password' => Hash::make('cacaloo@admin123'),
        ]);
        $sysadmin->assignRole('sysadmin');
    }
}
