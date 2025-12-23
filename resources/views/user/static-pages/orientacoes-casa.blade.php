@extends('layouts.user')

@section('title', 'Orientações da Casa')

@section('content')
<style>
    .orientacao-hero {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%) !important;
        border-radius: 2rem !important;
        padding: 4rem 2rem !important;
        color: white !important;
        margin-bottom: 3rem !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
    }

    .orientacao-card {
        background: white !important;
        border-radius: 1.5rem !important;
        border: 1px solid #E5E7EB !important;
        padding: 2.5rem !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .orientacao-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF2FF;
        color: #4338CA;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .btn-ler-mais {
        background: #4338CA !important;
        color: white !important;
        padding: 1rem 2rem !important;
        border-radius: 1rem !important;
        font-weight: 700 !important;
        transition: all 0.3s ease !important;
        margin-top: auto;
        text-align: center;
    }

    .btn-ler-mais:hover {
        background: #3730A3 !important;
        transform: scale(1.02) !important;
    }

    .modal-header-orientacao {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%) !important;
        padding: 2.5rem !important;
        color: white !important;
    }

    dialog::backdrop {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
    }
</style>

<div class="py-6 px-4">
    <div class="orientacao-hero">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">Diretrizes <span style="color: var(--gold-main)">Sagradas</span></h1>
        <p class="text-lg opacity-90 max-w-2xl animate-fade-in-up" style="animation-delay: 0.2s">Relacionamos aqui os princípios e mandamentos que norteiam nossa caminhada espiritual com disciplina, amor e caridade.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Mandamento 1 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-hands-praying"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">1. Honrar a Umbanda</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Respeitar a tradição, rituais, símbolos e ensinamentos. O médium deve manter a fé, a devoção e a conexão espiritual com os Orixás e Guias.</p>
        </div>

        <!-- Mandamento 2 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-heart"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">2. Amar e Servir</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Praticar a caridade verdadeira sem recompensas. Cada gesto deve refletir amor e solidariedade, oferecendo auxílio a todos que buscam orientação.</p>
        </div>

        <!-- Mandamento 3 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-sitemap"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">3. Respeitar a Hierarquia</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Honrar guias espirituais, mentores e dirigentes. Seguir suas orientações é essencial para garantir a segurança nos trabalhos mediúnicos.</p>
        </div>

        <!-- Mandamento 4 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-sparkles"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">4. Pureza de Intenção</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Agir com sinceridade e fé. Nenhum trabalho deve ser feito por vaidade ou interesse pessoal. A mediunidade é serviço, não poder.</p>
        </div>

        <!-- Mandamento 5 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-user-secret"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">5. Sigilo e Respeito</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Manter confidencialidade absoluta sobre tudo o que recebe nos atendimentos. Respeitar a privacidade do assistido é uma obrigação ética.</p>
        </div>

        <!-- Mandamento 6 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-book-open"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">6. Estudo e Evolução</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Dedicar-se ao aprendizado constante dos fundamentos e ao crescimento moral. A mediunidade exige responsabilidade e disciplina.</p>
        </div>

        <!-- Mandamento 7 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-church"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">7. Zelar pelo Espaço</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Contribuir para a harmonia e limpeza física e energética do templo. Cada ambiente deve ser tratado com reverência e cuidado.</p>
        </div>

        <!-- Mandamento 8 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-comments"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">8. Paciência e Compaixão</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Atender assistidos com escuta ativa e empatia. Transmitir conforto, esperança e equilíbrio para as dores de quem busca ajuda.</p>
        </div>

        <!-- Mandamento 9 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-infinity"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">9. Servir com Consistência</h3>
            <p class="text-gray-600 text-sm leading-relaxed">A dedicação reflete-se na vida diária. Demonstrar compromisso constante com a evolução própria e a ajuda ao próximo.</p>
        </div>

        <!-- Mandamento 10 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-shield-virus"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">10. Evitar Abusos</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Jamais usar a mediunidade para benefício próprio ou manipulação. O poder mediúnico é guiado sempre pela ética e pelo amor.</p>
        </div>

        <!-- Mandamento 11 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-leaf"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">11. Cultivar a Humildade</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Reconhecer limitações. A humildade fortalece a conexão com os guias e evita o orgulho espiritual no exercício mediúnico.</p>
        </div>

        <!-- Mandamento 12 -->
        <div class="orientacao-card">
            <div class="icon-circle"><i class="fa-solid fa-users"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">12. Harmonia e Unidade</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Atuar pelo bem coletivo, evitando conflitos. A harmonia entre médiuns e assistidos é vital para a fluidez das energias positivas.</p>
        </div>
    </div>
</div>
 
@endsection
