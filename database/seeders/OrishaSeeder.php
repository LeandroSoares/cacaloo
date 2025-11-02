<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orisha;

class OrishaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orishas = [
            // Linha da Direita - Orixás de Luz
            [
                'name' => 'Oxalá',
                'description' => 'O maior dos Orixás, pai de todos os outros Orixás. Representa a paz, a sabedoria e a criação. Sincretizado com Jesus Cristo.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Iemanjá',
                'description' => 'Rainha do mar e mãe de todos os Orixás. Protetora das águas salgadas, da maternidade e da família. Sincretizada com Nossa Senhora dos Navegantes.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Oxum',
                'description' => 'Orixá das águas doces, cachoeiras e rios. Representa o amor, a fertilidade, a riqueza e a beleza. Sincretizada com Nossa Senhora da Conceição.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Ogum',
                'description' => 'Orixá guerreiro, senhor dos caminhos e do ferro. Protetor dos trabalhadores e daqueles que lutam por justiça. Sincretizado com São Jorge.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Oxóssi',
                'description' => 'Orixá caçador, senhor das matas e florestas. Representa a fartura, a prosperidade e a sabedoria da natureza. Sincretizado com São Sebastião.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Xangô',
                'description' => 'Orixá da justiça, do fogo e do trovão. Rei poderoso que representa a autoridade, a liderança e o equilíbrio. Sincretizado com São Jerônimo.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Iansã',
                'description' => 'Orixá dos ventos, raios e tempestades. Senhora dos eguns (espíritos dos mortos) e guerreira destemida. Sincretizada com Santa Bárbara.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Oxumarê',
                'description' => 'Orixá do arco-íris, da chuva e da continuidade da vida. Representa a renovação, a transformação e os ciclos naturais. Sincretizado com São Bartolomeu.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Nanã',
                'description' => 'Orixá anciã das águas paradas e da lama primordial. Representa a sabedoria ancestral, a memória e os mistérios da vida e da morte. Sincretizada com Sant\'Ana.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Obá',
                'description' => 'Orixá guerreira das águas revoltas. Representa a determinação, a coragem feminina e a luta pelos ideais. Uma das esposas de Xangô.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Ewá',
                'description' => 'Orixá virgem das fontes e nascentes. Protetora da pureza, da juventude e dos segredos da natureza. Dona das águas cristalinas.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Ossaim',
                'description' => 'Orixá das plantas medicinais e da farmácia natural. Senhor dos segredos das folhas e das propriedades curativas da natureza.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],

            // Linha da Esquerda - Guardiões e Protetores
            [
                'name' => 'Exu',
                'description' => 'Mensageiro dos Orixás e guardião dos caminhos e encruzilhadas. Responsável pela comunicação entre os mundos e proteção espiritual.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Pombagira',
                'description' => 'Entidade feminina da linha da esquerda. Guardiã dos caminhos femininos, do amor, da sensualidade e da proteção das mulheres.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Exu Tranca Rua',
                'description' => 'Guardião das ruas e dos caminhos urbanos. Protetor contra demandas e trabalhos negativos, abrindo e fechando caminhos conforme a justiça.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Exu Caveira',
                'description' => 'Guardião dos cemitérios e senhor das almas. Trabalha com a transformação, o fim de ciclos e a proteção espiritual mais intensa.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Exu Mirim',
                'description' => 'Guardião infantil, protetor das crianças e da inocência. Trabalha com alegria, brincadeiras e proteção dos pequenos.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Pombagira Rosa Vermelha',
                'description' => 'Entidade feminina especializada em questões amorosas. Trabalha com relacionamentos, paixão e proteção das mulheres apaixonadas.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Exu Sete Encruzilhadas',
                'description' => 'Guardião das encruzilhadas e dos sete caminhos. Primeiro Exu a se manifestar na Umbanda, protetor da doutrina umbandista.',
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],

            // Orixás Especiais (podem trabalhar nas duas linhas conforme a necessidade)
            [
                'name' => 'Omulú/Obaluaiê',
                'description' => 'Orixá da saúde, das doenças e da cura. Senhor da terra e da transformação pela dor. Trabalha tanto na cura quanto nos mistérios da morte.',
                'is_right' => true,
                'is_left' => true,
                'active' => true,
            ],
            [
                'name' => 'Logunedé',
                'description' => 'Orixá jovem, filho de Oxum e Oxóssi. Representa a dualidade masculino/feminino, as águas e as matas. Protetor da juventude e da transformação.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
        ];

        foreach ($orishas as $orishaData) {
            Orisha::updateOrCreate(
                ['name' => $orishaData['name']],
                $orishaData
            );
        }

        $this->command->info('Orixás criados com sucesso!');
        $this->command->info('Total de Orixás: ' . count($orishas));
        $this->command->info('Linha da Direita: ' . collect($orishas)->where('is_right', true)->where('is_left', false)->count());
        $this->command->info('Linha da Esquerda: ' . collect($orishas)->where('is_left', true)->where('is_right', false)->count());
        $this->command->info('Ambas as linhas: ' . collect($orishas)->where('is_right', true)->where('is_left', true)->count());
    }
}
