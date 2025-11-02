<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders que não dependem de outros dados (ordem de prioridade)
        $this->call([
            // 1. Roles e Permissões (base do sistema de autorização)
            RolesAndPermissionsSeeder::class,

            // 2. Dados básicos do sistema espiritual
            MagicTypesSeeder::class,
            OrishaSeeder::class,

            // 3. Conteúdo e configurações
            HomeSectionsSeeder::class,
            CoursesSeeder::class,
            MysteriesSeeder::class,
            DailyMessageSeeder::class,
        ]);

        $this->command->info('🎉 Todos os seeders executados com sucesso!');
        $this->command->info('📊 Sistema inicializado com dados completos.');
    }
}
