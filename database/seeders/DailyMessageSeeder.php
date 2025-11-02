<?php

namespace Database\Seeders;

use App\Models\DailyMessage;
use Illuminate\Database\Seeder;

class DailyMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'title' => 'Pensamento do Dia',
                'message' => 'A vida é uma jornada de descoberta espiritual. Cada dia nos oferece uma nova oportunidade de crescer, aprender e nos conectar com nossa essência divina.',
                'author' => 'Sabedoria Ancestral',
                'active' => true,
                'notes' => 'Mensagem inspiradora geral sobre crescimento espiritual'
            ],
            [
                'title' => 'Reflexão Diária',
                'message' => 'Os orixás nos ensinam que a força reside na união com a natureza e no respeito aos nossos ancestrais. Que possamos honrar essa sabedoria em cada gesto.',
                'author' => 'Tradição Yorubá',
                'active' => true,
                'notes' => 'Foca na conexão com os orixás e ancestrais'
            ],
            [
                'title' => 'Mensagem de Luz',
                'message' => 'Em cada desafio há uma oportunidade de transformação. Como a água que contorna a rocha, devemos ser fluidos e persistentes em nossa jornada.',
                'author' => 'Filosofia da Natureza',
                'active' => true,
                'notes' => 'Analogia com elementos da natureza'
            ],
            [
                'title' => 'Sabedoria do Dia',
                'message' => 'O autoconhecimento é a chave que abre todas as portas. Quando compreendemos nossa essência, encontramos nosso lugar no universo.',
                'author' => null,
                'active' => true,
                'notes' => 'Mensagem sobre autoconhecimento'
            ],
            [
                'title' => 'Inspiração Matinal',
                'message' => 'Que a energia dos orixás ilumine seu caminho hoje. Oxalá traga paz, Iemanjá traga proteção, e Exú abra os caminhos para suas conquistas.',
                'author' => 'Bênção dos Orixás',
                'active' => true,
                'notes' => 'Bênção específica com nomes de orixás'
            ],
            [
                'title' => 'Reflexão Espiritual',
                'message' => 'A gratidão transforma o que temos em suficiente. Agradeça pelo dia que se inicia e pelas lições que virão.',
                'author' => null,
                'active' => true,
                'notes' => 'Foco em gratidão'
            ],
            [
                'title' => 'Pensamento Ancestral',
                'message' => 'Nossos ancestrais caminharam antes de nós para que pudéssemos chegar até aqui. Honre sua memória sendo a melhor versão de si mesmo.',
                'author' => 'Sabedoria Ancestral',
                'active' => true,
                'notes' => 'Honrar os ancestrais'
            ],
            [
                'title' => 'Energia do Dia',
                'message' => 'Como o sol nasce todos os dias renovando suas energias, você também pode renovar suas intenções e começar de novo a qualquer momento.',
                'author' => null,
                'active' => true,
                'notes' => 'Renovação e recomeço'
            ],
            [
                'title' => 'Mensagem de Força',
                'message' => 'Ogum nos ensina que com determinação e coragem podemos superar qualquer obstáculo. Use sua força interior para conquistar seus objetivos.',
                'author' => 'Força de Ogum',
                'active' => true,
                'notes' => 'Invoca a força de Ogum'
            ],
            [
                'title' => 'Sabedoria Natural',
                'message' => 'Observe a natureza: as árvores crescem devagar, mas com raízes profundas. Seu crescimento espiritual também requer paciência e bases sólidas.',
                'author' => 'Ensinamentos da Natureza',
                'active' => true,
                'notes' => 'Lição sobre paciência e crescimento'
            ],
            [
                'title' => 'Mensagem de Amor',
                'message' => 'Oxum nos lembra que o amor próprio é o primeiro passo para amar verdadeiramente os outros. Cuide de si com carinho e compaixão.',
                'author' => 'Doçura de Oxum',
                'active' => true,
                'notes' => 'Foco no amor próprio através de Oxum'
            ],
            [
                'title' => 'Reflexão da Noite',
                'message' => 'Nanã nos ensina que a sabedoria vem com o tempo e a experiência. Cada erro é um degrau na escada do aprendizado.',
                'author' => 'Sabedoria de Nanã',
                'active' => true,
                'notes' => 'Mensagem sobre aprender com erros'
            ],
            [
                'title' => 'Exemplo de Mensagem Inativa',
                'message' => 'Esta é uma mensagem de exemplo que está inativa para demonstrar o sistema.',
                'author' => 'Sistema',
                'active' => false,
                'notes' => 'Mensagem desativada para teste do sistema'
            ],
            [
                'title' => 'Mensagem com Validade',
                'message' => 'Esta mensagem tem período de validade definido para demonstrar o funcionamento do sistema de datas.',
                'author' => 'Sistema de Testes',
                'active' => true,
                'valid_from' => now()->subDays(10),
                'valid_until' => now()->addDays(30),
                'notes' => 'Mensagem com período de validade para teste'
            ],
            [
                'title' => 'Mensagem Expirada',
                'message' => 'Esta mensagem expirou para demonstrar como o sistema lida com mensagens fora do período de validade.',
                'author' => 'Sistema de Testes',
                'active' => true,
                'valid_from' => now()->subDays(30),
                'valid_until' => now()->subDays(1),
                'notes' => 'Mensagem expirada para teste do sistema'
            ]
        ];

        foreach ($messages as $messageData) {
            DailyMessage::create($messageData);
        }
    }
}
