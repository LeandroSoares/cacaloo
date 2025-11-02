<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Seed courses from the original Excel form.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Teologia e Sacerdócio',
                'description' => 'Curso básico de Teologia e Sacerdócio de Umbanda',
                'active' => true,
            ],
            [
                'name' => 'Oferendas',
                'description' => 'Curso sobre oferendas e rituais de Umbanda',
                'active' => true,
            ],
            [
                'name' => 'Exu do Fogo',
                'description' => 'Curso específico sobre Exu do Fogo',
                'active' => true,
            ],
            [
                'name' => 'Exu Mirim',
                'description' => 'Curso específico sobre Exu Mirim',
                'active' => true,
            ],
            [
                'name' => 'Exu do Ouro',
                'description' => 'Curso específico sobre Exu do Ouro',
                'active' => true,
            ],
            [
                'name' => 'Pombagira',
                'description' => 'Curso específico sobre Pombagira',
                'active' => true,
            ],
            [
                'name' => 'Teologia II',
                'description' => 'Curso avançado de Teologia de Umbanda',
                'active' => true,
            ],
            [
                'name' => 'Exu Guardião do Mar',
                'description' => 'Curso específico sobre Exu Guardião do Mar',
                'active' => true,
            ],
            [
                'name' => 'Benzimento',
                'description' => 'Curso sobre técnicas de benzimento',
                'active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['name' => $courseData['name']],
                $courseData
            );
        }

        $this->command->info('✅ Cursos padrão do Excel criados com sucesso!');
    }
}
