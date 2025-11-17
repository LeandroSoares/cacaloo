<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SysAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Criar um usuário Sysadmin inicial
        $sysadmin = User::firstOrCreate(
            ['email' => 'admin@cacaloo.com.br'],
            [
                'name' => 'Administrador do Sistema',
                'password' => Hash::make('cacaloo@admin123'),
                'is_active' => true,
            ]
        );

        // Atribuir apenas o role sysadmin (já possui todas as permissões)
        if (!$sysadmin->hasRole('sysadmin')) {
            $sysadmin->assignRole('sysadmin');
        }

        // Criar dados pessoais completos do sysadmin
        $sysadmin->personalData()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'name' => 'Administrador do Sistema',
                'birth_date' => '1990-01-01',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'email' => 'admin@cacaloo.com.br',
                'home_phone' => '(11) 3333-3333',
                'mobile_phone' => '(11) 99999-9999',
                'work_phone' => '(11) 4444-4444',
                'address' => 'Rua Exemplo, 123, Centro',
                'zip_code' => '01000-000',
                'emergency_contact' => 'Contato de Emergência - (11) 98888-8888',
            ]
        );

        // Criar informações religiosas do sysadmin
        $sysadmin->religiousInfo()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'start_date' => '2020-01-15',
                'start_location' => 'Templo Sagrado de Oxalá - São Paulo/SP',
                'charity_house_start' => '2020-03-01',
                'charity_house_end' => '2021-02-28',
                'charity_house_observations' => 'Período de aprendizado nas atividades de caridade',
                'development_start' => '2021-03-01',
                'development_end' => '2022-02-28',
                'service_start' => '2022-03-01',
                'umbanda_baptism' => '2020-09-21',
                'cambone_experience' => true,
                'cambone_start_date' => '2020-06-01',
                'cambone_end_date' => '2021-12-31',
            ]
        );

        // Criar formação sacerdotal do sysadmin
        $sysadmin->priestlyFormation()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'theology_start' => '2021-03-01',
                'theology_end' => '2022-02-28',
                'priesthood_start' => '2022-03-01',
                'priesthood_end' => '2024-02-29',
            ]
        );

        // Criar coroação do sysadmin
        $sysadmin->crowning()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'start_date' => '2022-09-21',
                'end_date' => '2022-09-23',
                'guide_name' => 'Pai João das Almas',
                'priest_name' => 'Pai Benedito de Aruanda',
                'temple_name' => 'Templo Sagrado de Oxalá',
            ]
        );

        // Criar orixás de cabeça do sysadmin
        $sysadmin->headOrisha()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'ancestor' => 'Oxalá',
                'front' => 'Yemanjá',
                'front_together' => 'Oxum',
                'adjunct' => 'Nanã',
                'adjunct_together' => null,
                'left_side' => 'Oxóssi',
                'left_side_together' => 'Ogum',
                'right_side' => 'Xangô',
                'right_side_together' => 'Iansã',
            ]
        );

        // Criar cruz de força do sysadmin
        $sysadmin->forceCross()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'top' => 'Oxalá',
                'bottom' => 'Yemanjá',
                'left' => 'Oxóssi',
                'right' => 'Ogum',
            ]
        );

        // Criar guias de trabalho do sysadmin
        $sysadmin->workGuide()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'caboclo' => 'Caboclo Sete Flechas',
                'cabocla' => 'Cabocla Jurema',
                'ogum' => 'Ogum Beira-Mar',
                'xango' => 'Xangô Kaô',
                'baiano' => 'Baiano Zé do Coco',
                'baiana' => 'Baiana Rosa',
                'preto_velho' => 'Preto Velho Pai Joaquim',
                'preta_velha' => 'Preta Velha Maria Conga',
                'marinheiro' => 'Marinheiro João da Barca',
                'ere' => 'Erê Cosme e Damião',
                'exu' => 'Exu Tranca Ruas',
                'pombagira' => 'Pomba Gira Maria Padilha',
                'exu_mirim' => 'Exu Mirim Gira Mundo',
            ]
        );

        // Criar último templo do sysadmin
        $sysadmin->lastTemple()->firstOrCreate(
            ['user_id' => $sysadmin->id],
            [
                'name' => 'Templo Sagrado de Oxalá',
                'address' => 'São Paulo - SP',
                'leader_name' => 'Pai Benedito de Aruanda',
                'function' => 'Administrador e Sacerdote',
                'exit_reason' => null, // Ainda ativo
            ]
        );
    }
}
