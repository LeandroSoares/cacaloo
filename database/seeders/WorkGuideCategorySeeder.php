<?php

namespace Database\Seeders;

use App\Models\WorkGuideCategory;
use Illuminate\Database\Seeder;

class WorkGuideCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Caboclo', 'slug' => 'caboclo', 'icon' => '🌿', 'display_order' => 1, 'is_active' => true],
            ['name' => 'Cabocla', 'slug' => 'cabocla', 'icon' => '🌸', 'display_order' => 2, 'is_active' => true],
            ['name' => 'Ogum', 'slug' => 'ogum', 'icon' => '⚔️', 'display_order' => 3, 'is_active' => true],
            ['name' => 'Xangô', 'slug' => 'xango', 'icon' => '⚡', 'display_order' => 4, 'is_active' => true],
            ['name' => 'Baiano', 'slug' => 'baiano', 'icon' => '🎩', 'display_order' => 5, 'is_active' => true],
            ['name' => 'Baiana', 'slug' => 'baiana', 'icon' => '💃', 'display_order' => 6, 'is_active' => true],
            ['name' => 'Preto Velho', 'slug' => 'preto_velho', 'icon' => '👴', 'display_order' => 7, 'is_active' => true],
            ['name' => 'Preta Velha', 'slug' => 'preta_velha', 'icon' => '👵', 'display_order' => 8, 'is_active' => true],
            ['name' => 'Marinheiro', 'slug' => 'marinheiro', 'icon' => '⚓', 'display_order' => 9, 'is_active' => true],
            ['name' => 'Erê', 'slug' => 'ere', 'icon' => '🧒', 'display_order' => 10, 'is_active' => true],
            ['name' => 'Exu', 'slug' => 'exu', 'icon' => '🔱', 'display_order' => 11, 'is_active' => true],
            ['name' => 'Pombagira', 'slug' => 'pombagira', 'icon' => '💋', 'display_order' => 12, 'is_active' => true],
            ['name' => 'Exu Mirim', 'slug' => 'exu_mirim', 'icon' => '👦', 'display_order' => 13, 'is_active' => true],
        ];

        foreach ($categories as $category) {
            WorkGuideCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
