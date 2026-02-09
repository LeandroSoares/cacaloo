<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SysAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sysadminList = [
            [
                'name' => 'Administrador do Sistema',
                'email' => 'admin@cacaloo.com.br',
                'password' => Hash::make(env('SYSADMIN_PASSWORD', 'cacaloo@admin123')),
                'is_active' => true,
            ],
        ];
        // Criar um usuário Sysadmin inicial
        foreach ($sysadminList as $sysadmin) {
            $sysadmin = User::firstOrCreate(
                ['email' => $sysadmin['email']],
                [
                    'name' => $sysadmin['name'],
                    'password' => $sysadmin['password'],
                    'is_active' => $sysadmin['is_active'],
                ]
            );
            if (! $sysadmin->hasRole('sysadmin')) {
                $sysadmin->assignRole('sysadmin');
            }
            if (! $sysadmin->hasRole('admin')) {
                $sysadmin->assignRole('admin');
            }
            if (! $sysadmin->hasRole('manager')) {
                $sysadmin->assignRole('manager');
            }
            if (! $sysadmin->hasRole('user')) {
                $sysadmin->assignRole('user');
            }
        }
    }
}
