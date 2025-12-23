@extends('layouts.user')

@section('title', 'Lendas dos Orixás')

@section('content')
<style>
    /* Custom styles to ensure visibility without depending on Tailwind classes that might not be in the bundle */
    .hero-premium {
        background: linear-gradient(135deg, #1B4332 0%, #2E7D32 50%, #D4AF37 100%) !important;
        border-radius: 2rem !important;
        padding: 4rem 2rem !important;
        color: white !important;
        position: relative !important;
        overflow: hidden !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
        margin-bottom: 3rem !important;
    }

    .hero-premium h1 {
        font-size: 3.5rem !important;
        font-weight: 800 !important;
        margin-bottom: 1rem !important;
        color: white !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.4) !important;
    }

    .hero-premium p {
        font-size: 1.25rem !important;
        max-width: 800px !important;
        opacity: 0.95 !important;
        line-height: 1.6 !important;
        color: #F3F4F6 !important;
    }

    .orixa-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
        gap: 2rem !important;
        margin-top: 2rem !important;
    }

    .orixa-card {
        background: white !important;
        border-radius: 1.5rem !important;
        border: 1px solid #E5E7EB !important;
        padding: 2.5rem !important;
        transition: all 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }

    .orixa-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
    }

    .icon-box {
        width: 70px !important;
        height: 70px !important;
        border-radius: 1.25rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 1.5rem !important;
        font-size: 2rem !important;
    }

    .btn-conhecer {
        margin-top: auto !important;
        padding: 1.25rem !important;
        border-radius: 1.25rem !important;
        font-weight: 800 !important;
        text-align: center !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        font-size: 0.9rem !important;
    }

    .modal-header-premium {
        padding: 3rem 2rem !important;
        color: white !important;
        position: relative !important;
    }

    .modal-header-premium h2 {
        color: white !important;
        margin: 0 !important;
    }

    /* Cores Específicas */
    .oxossi-theme { border-top: 8px solid #2E7D32 !important; }
    .oxossi-btn { background: #2E7D32 !important; color: white !important; }
    .oxossi-btn:hover { background: #1B5E20 !important; }
    .oxossi-icon { background: #E8F5E9 !important; color: #2E7D32 !important; }

    .ogum-theme { border-top: 8px solid #C62828 !important; }
    .ogum-btn { background: #C62828 !important; color: white !important; }
    .ogum-btn:hover { background: #B71C1C !important; }
    .ogum-icon { background: #FFEBEE !important; color: #C62828 !important; }

    .iemanja-theme { border-top: 8px solid #0284C7 !important; }
    .iemanja-btn { background: #0284C7 !important; color: white !important; }
    .iemanja-btn:hover { background: #0369A1 !important; }
    .iemanja-icon { background: #F0F9FF !important; color: #0284C7 !important; }

    .oxala-theme { border-top: 8px solid #94A3B8 !important; }
    .oxala-btn { background: #94A3B8 !important; color: white !important; }
    .oxala-btn:hover { background: #64748B !important; }
    .oxala-icon { background: #F8FAFC !important; color: #64748B !important; }

    .xango-theme { border-top: 8px solid #9A3412 !important; }
    .xango-btn { background: #9A3412 !important; color: white !important; }
    .xango-btn:hover { background: #7C2D12 !important; }
    .xango-icon { background: #FFF7ED !important; color: #9A3412 !important; }

    .iansa-theme { border-top: 8px solid #B91C1C !important; }
    .iansa-btn { background: #B91C1C !important; color: white !important; }
    .iansa-btn:hover { background: #991B1B !important; }
    .iansa-icon { background: #FEF2F2 !important; color: #B91C1C !important; }

    dialog::backdrop {
        background: rgba(0, 0, 0, 0.8) !important;
        backdrop-filter: blur(10px) !important;
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="py-6 px-4 animate-fade-in">
    <!-- Hero Section -->
    <div class="hero-premium">
        <div class="relative z-10">
            <h1>Lendas dos <span style="color: #F4D365">Orixás</span></h1>
            <p>
                Descubra os mistérios e a sabedoria das divindades que regem o universo. Cada lenda é um portal para a compreensão das forças da natureza e do espírito humano.
            </p>
        </div>
    </div>

    <!-- Orixás Grid -->
    <div class="orixa-grid">
        <!-- Oxóssi -->
        <div class="orixa-card oxossi-theme text-center md:text-left">
            <div class="icon-box oxossi-icon mx-auto md:mx-0">
                <i class="fa-solid fa-leaf"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Oxóssi</h3>
            <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 block">Rei das Matas • Conhecimento</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Senhor da caça e mestre das ervas sagradas. Aquele que traz a fartura e o foco com sua flecha de um só tiro.</p>
            <button onclick="document.getElementById('modalOxossi').showModal()" class="btn-conhecer oxossi-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>

        <!-- Ogum -->
        <div class="orixa-card ogum-theme text-center md:text-left">
            <div class="icon-box ogum-icon mx-auto md:mx-0">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Ogum</h3>
            <span class="text-xs font-black text-red-700 uppercase tracking-widest mb-4 block">Guerreiro da Lei • Caminhos</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Orixá do ferro e da coragem. O protetor que abre caminhos e corta as demandas com sua espada justiceira.</p>
            <button onclick="document.getElementById('modalOgum').showModal()" class="btn-conhecer ogum-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>

        <!-- Iemanjá -->
        <div class="orixa-card iemanja-theme text-center md:text-left">
            <div class="icon-box iemanja-icon mx-auto md:mx-0">
                <i class="fa-solid fa-water"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Iemanjá</h3>
            <span class="text-xs font-black text-blue-700 uppercase tracking-widest mb-4 block">Rainha do Mar • Mãe de Todos</span>
            <p class="text-gray-600 mb-6 leading-relaxed">A grande mãe que rege os oceanos e o equilíbrio emocional. Protege a família e acalma as tempestades da alma.</p>
            <button onclick="document.getElementById('modalIemanja').showModal()" class="btn-conhecer iemanja-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>

        <!-- Oxalá -->
        <div class="orixa-card oxala-theme text-center md:text-left">
            <div class="icon-box oxala-icon mx-auto md:mx-0">
                <i class="fa-solid fa-dove"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Oxalá</h3>
            <span class="text-xs font-black text-gray-500 uppercase tracking-widest mb-4 block">Pai da Paz • Criação</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Divindade suprema da paz e da pureza. Orixá que rege a criação da humanidade e a evolução espiritual de todos.</p>
            <button onclick="document.getElementById('modalOxala').showModal()" class="btn-conhecer oxala-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>

        <!-- Xangô -->
        <div class="orixa-card xango-theme text-center md:text-left">
            <div class="icon-box xango-icon mx-auto md:mx-0">
                <i class="fa-solid fa-gavel"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Xangô</h3>
            <span class="text-xs font-black text-orange-800 uppercase tracking-widest mb-4 block">Rei da Justiça • Equilíbrio</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Senhor do fogo, do trovão e das leis universais. Aquele que aplica a justiça correta e rege o conhecimento.</p>
            <button onclick="document.getElementById('modalXango').showModal()" class="btn-conhecer xango-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>

        <!-- Iansã -->
        <div class="orixa-card iansa-theme text-center md:text-left">
            <div class="icon-box iansa-icon mx-auto md:mx-0">
                <i class="fa-solid fa-wind"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Iansã</h3>
            <span class="text-xs font-black text-red-600 uppercase tracking-widest mb-4 block">Dona dos Ventos • Paixão</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Rainha das tempestades e guerreira livre. Rege a transmutação das energias e os movimentos da vida.</p>
            <button onclick="document.getElementById('modalIansa').showModal()" class="btn-conhecer iansa-btn shadow-lg active:scale-95">Ver Ancestralidade</button>
        </div>
    </div>
</div>

<!-- Modais -->
<x-modal-premium 
    id="modalOxossi" 
    title="Lenda de Oxóssi" 
    subtitle="O Caçador de uma flecha só • Okê Arô!" 
    icon="fa-solid fa-leaf" 
    headerGradient="linear-gradient(135deg, #2E7D32 0%, #1B4332 100%)"
>
    <p>Diz a lenda que houve um tempo em que aves de mau agouro, enviadas por forças sombrias, assolavam o reino de Ifé, trazendo doença e tristeza para o povo.</p>
    <p>Todos os grandes guerreiros tentaram derrotá-las, mas suas flechas não atingiam o alvo, protegidas que estavam por sortilégios. Foi então que surgiu um jovem e humilde caçador.</p>
    <p><strong>Em posse de sua única flecha,</strong> ele não tremeu. Com silêncio absoluto e conexão total com o espírito da mata, ele mirou o coração da ave principal. Com um único disparo sagrado, a ave caiu, o feitiço se quebrou e a luz voltou ao reino.</p>
    <p>Desde esse dia, Olodumare o consagrou o Rei das Matas e senhor de todo o conhecimento que a terra provê. <strong>Abundância e foco!</strong></p>
</x-modal-premium>

<x-modal-premium 
    id="modalOgum" 
    title="Lenda de Ogum" 
    subtitle="O Senhor dos Caminhos • Patacorí Ogum!" 
    icon="fa-solid fa-shield-halved" 
    headerGradient="linear-gradient(135deg, #C62828 0%, #8E0000 100%)"
>
    <p>Ogum é o Orixá ferreiro, guerreiro e desbravador. Conta a lenda que ele foi o primeiro a descer do Orun (céu) para o Ayé (terra) para preparar o mundo para os outros Orixás.</p>
    <p>Com sua espada de ferro, ele cortou as matas e abriu os caminhos. Ele é aquele que vence as demandas e protege os trabalhadores. Onde há uma estrada, há a presença de Ogum.</p>
    <p><strong>Coragem e determinação!</strong> Ogum não conhece o medo e nos ensina a lutar nossas batalhas com dignidade e força.</p>
</x-modal-premium>

<x-modal-premium 
    id="modalIemanja" 
    title="Lenda de Iemanjá" 
    subtitle="Rainha do Mar • Odoyá!" 
    icon="fa-solid fa-water" 
    headerGradient="linear-gradient(135deg, #0284C7 0%, #0369A1 100%)"
>
    <p>Iemanjá é a mãe de quase todos os Orixás. Ela representa a fertilidade e o amor maternal. Diz a lenda que ela é tão generosa que seu corpo se transformou nos rios e oceanos para dar vida à terra.</p>
    <p>Ela acalma as mentes perturbadas e protege os pescadores. Seus domínios são as águas salgadas, onde ela lava nossas dores e renova nossas esperanças.</p>
    <p><strong>Equilíbrio e acolhimento!</strong> Iemanjá nos ensina que o amor é a maior força do universo.</p>
</x-modal-premium>

<x-modal-premium 
    id="modalOxala" 
    title="Lenda de Oxalá" 
    subtitle="O Grande Pai • Epa Babá!" 
    icon="fa-solid fa-dove" 
    headerGradient="linear-gradient(135deg, #94A3B8 0%, #64748B 100%)"
>
    <p>Oxalá é o Orixá da paz e da pureza. Ele é o mais velho de todos e o regente da criação. Conta a lenda que ele moldou o ser humano do barro e lhe deu o sopro da vida.</p>
    <p>Ele veste o branco imaculado e carrega o Opaxorô, o cajado da criação. Oxalá nos guia no caminho da evolução e da sabedoria espiritual.</p>
    <p><strong>Paz e renovação!</strong> Sob o manto de Oxalá, encontramos o descanso e a clareza necessária para seguir adiante.</p>
</x-modal-premium>

<x-modal-premium 
    id="modalXango" 
    title="Lenda de Xangô" 
    subtitle="O Rei da Justiça • Kaô Kabecilê!" 
    icon="fa-solid fa-gavel" 
    headerGradient="linear-gradient(135deg, #9A3412 0%, #7C2D12 100%)"
>
    <p>Xangô é o rei de Oyó, o senhor do fogo e da justiça. Diz a lenda que ele não suporta a injustiça e que seu machado de duas lâminas (Oxê) pune os mentirosos e protege os justos.</p>
    <p>Ele mora nas pedreiras e seu poder é sentido no som do trovão. Xangô é o Orixá que rege o conhecimento e a aplicação correta das leis divinas.</p>
    <p><strong>Justiça e autoridade!</strong> Xangô nos ensina que colhemos exatamente o que plantamos.</p>
</x-modal-premium>

<x-modal-premium 
    id="modalIansa" 
    title="Lenda de Iansã" 
    subtitle="A Senhora dos Ventos • Eparrey Iansã!" 
    icon="fa-solid fa-wind" 
    headerGradient="linear-gradient(135deg, #B91C1C 0%, #991B1B 100%)"
>
    <p>Iansã é a senhora dos ventos, dos raios e das tempestades. Uma guerreira destemida que não se curva a ninguém. Conta a lenda que ela é a única que não tem medo dos espíritos dos mortos (Eguns), guiando-os com seu vento para a luz.</p>
    <p>Ela é a força da transformação rápida e da paixão. Iansã movimenta o que está estagnado e traz o frescor da mudança.</p>
    <p><strong>Movimento e coragem!</strong> Iansã nos ensina a abraçar as tempestades da vida como oportunidades de crescimento.</p>
</x-modal-premium>

@endsection
