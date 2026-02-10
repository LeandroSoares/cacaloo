<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\WorkGuideCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buscar todas as categorias para mapear slug → id
        $categories = WorkGuideCategory::all()->keyBy('slug');

        if ($categories->isEmpty()) {
            echo "⚠️  Nenhuma categoria encontrada! Execute o seeder primeiro.\n";
            return;
        }

        // Buscar todos os registros da tabela work_guides
        $workGuides = DB::table('work_guides')->get();

        if ($workGuides->isEmpty()) {
            echo "✅ Nenhum dado para migrar em work_guides\n";
            return;
        }

        $migratedCount = 0;
        $skippedCount = 0;

        foreach ($workGuides as $guide) {
            // Para cada campo da estrutura antiga, criar entrada na nova estrutura
            $fieldsToMigrate = [
                'caboclo' => 'caboclo',
                'cabocla' => 'cabocla',
                'ogum' => 'ogum',
                'xango' => 'xango',
                'baiano' => 'baiano',
                'baiana' => 'baiana',
                'preto_velho' => 'preto_velho',
                'preta_velha' => 'preta_velha',
                'marinheiro' => 'marinheiro',
                'ere' => 'ere',
                'exu' => 'exu',
                'pombagira' => 'pombagira',
                'exu_mirim' => 'exu_mirim',
            ];

            foreach ($fieldsToMigrate as $slug => $field) {
                $value = $guide->{$field};

                // Apenas migrar se houver valor
                if (empty($value)) {
                    continue;
                }

                // Buscar categoria correspondente
                $category = $categories->get($slug);

                if (!$category) {
                    echo "⚠️  Categoria não encontrada para slug: {$slug}\n";
                    $skippedCount++;
                    continue;
                }

                // Inserir ou atualizar na nova tabela
                DB::table('work_guide_user_values')->updateOrInsert(
                    [
                        'user_id' => $guide->user_id,
                        'category_id' => $category->id,
                    ],
                    [
                        'value' => $value,
                        'created_at' => $guide->created_at ?? now(),
                        'updated_at' => $guide->updated_at ?? now(),
                    ]
                );

                $migratedCount++;
            }
        }

        echo "✅ Migração concluída!\n";
        echo "   📊 {$migratedCount} valores migrados\n";
        echo "   ⏭️  {$skippedCount} valores vazios ignorados\n";
        echo "   👥 {$workGuides->count()} usuários processados\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: limpar dados migrados
        echo "⚠️  Revertendo migração de dados...\n";

        DB::table('work_guide_user_values')->truncate();

        echo "✅ Dados de work_guide_user_values removidos\n";
    }
};
