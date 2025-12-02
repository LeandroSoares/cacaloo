<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeSection;
use App\Models\HomeSectionCard;

class HomeSectionsSeeder extends Seeder
{
    /**
     * Executa o seeder das seções da home page.
     */
    public function run(): void
    {
        // Obter dados do config centro.php
        $centroConfig = config('centro');

        // ====================================
        // SEÇÃO HERO
        // ====================================
        $heroSection = HomeSection::updateOrCreate(
            ['section_key' => 'hero'],
            [
                'title_line1' => 'Casa de Caridade',
                'title_line2' => 'Legião de Oxóssi e Ogum',
                'subtitle' => 'Um espaço de acolhimento, caridade e conexão espiritual',
                'background_color' => '#2E7D32',
                'is_visible' => true,
                'sort_order' => 1,
            ]
        );

        // ====================================
        // SEÇÃO SOBRE
        // ====================================
        $aboutSection = HomeSection::updateOrCreate(
            ['section_key' => 'about'],
            [
                'title' => 'Sobre Nossa Casa',
                'subtitle' => 'Conheça nossa história, missão e os Orixás que guiam nosso caminho',
                'content' => $centroConfig['descricao'] ?? 'Centro espírita dedicado ao desenvolvimento mediúnico e à caridade cristã, sob a proteção de Oxóssi e Ogum.',
                'is_visible' => true,
                'sort_order' => 2,
            ]
        );

        // Cards da seção Sobre
        $aboutCards = [
            [
                'title' => 'Nossa História',
                'content' => 'Fundada com o propósito de promover a caridade e o desenvolvimento espiritual por meio da Umbanda Sagrada. Há anos acolhemos filhos de fé em busca de orientação e crescimento espiritual.',
                'icon' => 'book-open',
                'sort_order' => 1,
            ],
            [
                'title' => 'Nossa Missão',
                'content' => 'Promover a caridade, o desenvolvimento mediúnico e a evolução espiritual através dos ensinamentos dos Orixás. Oferecemos um ambiente de acolhimento, amor e orientação para todos que buscam a luz.',
                'icon' => 'heart',
                'sort_order' => 2,
            ],
            [
                'title' => 'Nossos Valores',
                'content' => 'Fé, caridade, amor ao próximo, respeito à natureza e aos Orixás. Cultivamos a humildade, a solidariedade e o compromisso com o bem-estar espiritual e material de nossa comunidade.',
                'icon' => 'users',
                'sort_order' => 3,
            ],
        ];

        // Limpar cards existentes e criar novos
        $aboutSection->cards()->delete();
        foreach ($aboutCards as $cardData) {
            HomeSectionCard::create([
                'home_section_id' => $aboutSection->id,
                'title' => $cardData['title'],
                'content' => $cardData['content'],
                'icon' => $cardData['icon'],
                'sort_order' => $cardData['sort_order'],
                'is_visible' => true,
            ]);
        }

        // ====================================
        // SEÇÃO EVENTOS
        // ====================================
        HomeSection::updateOrCreate(
            ['section_key' => 'events'],
            [
                'title' => 'Giras e Eventos',
                'subtitle' => 'Confira nossa programação e participe conosco das giras e celebrações espirituais',
                'content' => "Horários de funcionamento:\n" .
                    "• Sextas-feiras: " . ($centroConfig['horarios']['sexta'] ?? '20h00 às 22h00') . "\n" .
                    "• Giras especiais conforme calendário espiritual\n" .
                    "• Consulte nossa programação mensal",
                'is_visible' => true,
                'sort_order' => 3,
            ]
        );

        // ====================================
        // SEÇÃO CONTATO
        // ====================================
        $endereco = $centroConfig['endereco'] ?? [];
        $contato = $centroConfig['contato'] ?? [];
        $redes = $centroConfig['redes_sociais'] ?? $centroConfig['redes'] ?? [];

        $contactContent = "";

        HomeSection::updateOrCreate(
            ['section_key' => 'contact'],
            [
                'title' => 'Entre em Contato',
                'subtitle' => 'Estamos aqui para atendê-lo com carinho e dedicação',
                'content' => $contactContent,
                'is_visible' => true,
                'sort_order' => 4,
            ]
        );

        $this->command->info('✅ Seções da home page criadas com sucesso!');
        $this->command->info('📝 Dados baseados em config/centro.php e valores padrão dos componentes');
        $this->command->info('🎯 Seções criadas: Hero, Sobre (com 3 cards), Eventos, Contato');
    }
}
