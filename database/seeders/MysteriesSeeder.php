<?php

namespace Database\Seeders;

use App\Models\Mystery;
use Illuminate\Database\Seeder;

class MysteriesSeeder extends Seeder
{
    /**
     * Seed mysteries from the original Excel form.
     */
    public function run(): void
    {
        $mysteries = [
            [
                'name' => 'Brajá do Guardião',
                'description' => 'Mistério do Brajá do Guardião',
                'active' => true,
            ],
            [
                'name' => 'Cordões',
                'description' => 'Mistério dos Cordões',
                'active' => true,
            ],
            [
                'name' => 'Toalha Branca',
                'description' => 'Mistério da Toalha Branca',
                'active' => true,
            ],
            [
                'name' => 'Fitas',
                'description' => 'Mistério das Fitas',
                'active' => true,
            ],
            [
                'name' => 'Pembas',
                'description' => 'Mistério das Pembas',
                'active' => true,
            ],
            [
                'name' => 'Mé Oxum',
                'description' => 'Mistério do Mé Oxum',
                'active' => true,
            ],
            [
                'name' => 'Pai Curador',
                'description' => 'Mistério do Pai Curador',
                'active' => true,
            ],
            [
                'name' => 'Toalha dos Orixás',
                'description' => 'Mistério da Toalha dos Orixás',
                'active' => true,
            ],
            [
                'name' => 'Sete Folhas',
                'description' => 'Mistério das Sete Folhas',
                'active' => true,
            ],
            [
                'name' => 'Divino do Olho de Deus',
                'description' => 'Mistério do Divino do Olho de Deus',
                'active' => true,
            ],
        ];

        foreach ($mysteries as $mysteryData) {
            Mystery::firstOrCreate(
                ['name' => $mysteryData['name']],
                $mysteryData
            );
        }

        $this->command->info('✅ Mistérios padrão do Excel criados com sucesso!');
    }
}
