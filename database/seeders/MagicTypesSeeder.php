<?php

namespace Database\Seeders;

use App\Models\MagicType;
use Illuminate\Database\Seeder;

class MagicTypesSeeder extends Seeder
{
    /**
     * Seed the magic types table.
     */
    public function run(): void
    {
        $magicTypes = [
            ['name' => 'Magia Cigana', 'description' => 'Trabalhos com a energia dos povos ciganos'],
            ['name' => 'Magia do Oriente', 'description' => 'Trabalhos com a energia dos mestres orientais'],
            ['name' => 'Magia Banto', 'description' => 'Trabalhos com a energia dos povos bantos'],
            ['name' => 'Magia Yorubá', 'description' => 'Trabalhos com a energia dos povos yorubás'],
            ['name' => 'Magia Elemental', 'description' => 'Trabalhos com a energia dos elementos da natureza'],
            ['name' => 'Magia dos Orixás', 'description' => 'Trabalhos com a energia dos orixás'],
            ['name' => 'Magia dos Guardiões', 'description' => 'Trabalhos com a energia dos guardiões espirituais'],
            ['name' => 'Magia dos Ancestrais', 'description' => 'Trabalhos com a energia dos ancestrais'],
        ];

        foreach ($magicTypes as $magicType) {
            MagicType::create($magicType);
        }
    }
}
