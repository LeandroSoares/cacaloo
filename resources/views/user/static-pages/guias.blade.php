@extends('layouts.user')

@section('title', 'Guia de Entidades')

@section('content')
<style>
    .guias-hero {
        background: linear-gradient(135deg, #166534 0%, #15803d 50%, #ca8a04 100%) !important;
        border-radius: 2rem !important;
        padding: 4rem 2rem !important;
        color: white !important;
        margin-bottom: 3rem !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
    }

    .guia-card {
        background: white !important;
        border-radius: 1.5rem !important;
        border: 1px solid #E5E7EB !important;
        padding: 2.5rem !important;
        transition: all 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        box-shadow: 0 10px 15px -10px rgba(0, 0, 0, 0.1) !important;
        text-align: center;
    }

    .guia-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
    }

    .guia-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        font-size: 1.75rem;
    }

    .btn-guia {
        margin-top: auto !important;
        padding: 0.75rem 2rem !important;
        border-radius: 1rem !important;
        font-weight: 700 !important;
        transition: all 0.3s ease !important;
        color: white !important;
    }
</style>

<div class="py-6 px-4">
    <div class="guias-hero">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">Linhas de <span style="color: #F4D365">Umbanda</span></h1>
        <p class="text-lg opacity-90 max-w-2xl animate-fade-in-up" style="animation-delay: 0.2s">Conheça as diversas falanges e entidades que compõem a rica espiritualidade da Umbanda, cada uma com sua missão, força e sabedoria.</p>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Caboclo Vigia -->
    <div class="guia-card" style="border-top: 8px solid #059669">
        <div class="guia-icon" style="background: #ECFDF5; color: #059669">
            <i class="fa-solid fa-eye"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">Caboclo Vigia</h3>
        <p class="text-xs font-black text-green-700 uppercase tracking-widest mb-4">Guardião da Mata</p>
        <p class="text-gray-600 mb-6 leading-relaxed">Espírito ancestral das matas e representante de Oxalá. Atua como vigilante e protetor da natureza sagrada.</p>
        <button onclick="document.getElementById('vigia').showModal()" class="btn-guia shadow-md active:scale-95" style="background: #059669">Ler mais</button>
    </div>

    <!-- Bruxas -->
    <div class="guia-card" style="border-top: 8px solid #7E22CE">
        <div class="guia-icon" style="background: #F5F3FF; color: #7E22CE">
            <i class="fa-solid fa-hat-wizard"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">Bruxas</h3>
        <p class="text-xs font-black text-purple-700 uppercase tracking-widest mb-4">Magia & Transformação</p>
        <p class="text-gray-600 mb-6 leading-relaxed">Mestras da manipulação energética e alta magia. Atuam no equilíbrio das forças e transmutação para o bem.</p>
        <button onclick="document.getElementById('bruxas').showModal()" class="btn-guia shadow-md active:scale-95" style="background: #7E22CE">Ler mais</button>
    </div>


    <!-- Pombagira Mirim -->
    <div class="guia-card" style="border-top: 8px solid #DC2626">
        <div class="guia-icon" style="background: #FEF2F2; color: #DC2626">
            <i class="fa-solid fa-child"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">Pombagira Mirim</h3>
        <p class="text-xs font-black text-red-700 uppercase tracking-widest mb-4">Forças da Alegria</p>
        <p class="text-gray-600 mb-6 leading-relaxed">Atuam com doçura e alegria na transformação emocional. Trazem a pureza e a força renovadora.</p>
        <button onclick="document.getElementById('mirim').showModal()" class="btn-guia shadow-md active:scale-95" style="background: #DC2626">Ler mais</button>
    </div>

    <!-- Linha das Almas -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-gray-700 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-gray-200 text-gray-700 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-skull text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Almas</h3>
            <p class="text-sm text-gray-700 font-semibold text-center mb-6 uppercase">Mistério & Elevação</p>
            <p class="text-gray-600 text-justify mb-4">Linhas de evolução espiritual profunda, ligadas à transição e cura...</p>
            <button class="mt-4 w-full bg-gray-700 text-white py-2 rounded-lg" 
                onclick="document.getElementById('almas').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha das Ondinas -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-blue-400 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-500 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-water text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Ondinas</h3>
            <p class="text-sm text-blue-500 font-semibold text-center mb-6 uppercase">Forças da Água</p>
            <p class="text-gray-600 text-justify mb-4">Seres ligados às águas, à fluidez emocional e ao magnetismo...</p>
            <button class="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg" 
                onclick="document.getElementById('ondinas').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha das Pretas Velhas -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-amber-700 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-700 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-hand-holding-heart text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Pretas Velhas</h3>
            <p class="text-sm text-amber-700 font-semibold text-center mb-6 uppercase">Sabedoria & Curva</p>
            <p class="text-gray-600 text-justify mb-4">Mães espirituais, conselheiras e curadoras ancestrais...</p>
            <button class="mt-4 w-full bg-amber-700 text-white py-2 rounded-lg" 
                onclick="document.getElementById('pretas').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha das Sereias -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-cyan-500 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-cyan-100 text-cyan-600 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-fish text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Sereias</h3>
            <p class="text-sm text-cyan-600 font-semibold text-center mb-6 uppercase">Encanto das Águas</p>
            <p class="text-gray-600 text-justify mb-4">Seres das águas profundas que trabalham magnetismo e sensualidade sagrada...</p>
            <button class="mt-4 w-full bg-cyan-600 text-white py-2 rounded-lg" 
                onclick="document.getElementById('sereias').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha dos Baianos -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-yellow-500 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-sun text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Baianos</h3>
            <p class="text-sm text-yellow-600 font-semibold text-center mb-6 uppercase">Alegria & Força</p>
            <p class="text-gray-600 text-justify mb-4">Trabalham com energia vibrante, coragem e descontração...</p>
            <button class="mt-4 w-full bg-yellow-600 text-white py-2 rounded-lg" 
                onclick="document.getElementById('baianos').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha dos Boiadeiros -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-orange-600 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-600 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-hat-cowboy text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Boiadeiros</h3>
            <p class="text-sm text-orange-600 font-semibold text-center mb-6 uppercase">Força & Coragem</p>
            <p class="text-gray-600 text-justify mb-4">Entidades de grande bravura ligadas ao campo e ao comando energético...</p>
            <button class="mt-4 w-full bg-orange-600 text-white py-2 rounded-lg" 
                onclick="document.getElementById('boiadeiros').showModal()">
                Ler mais
            </button>
        </div>
    </div>

<!-- Card - Linha de Caboclas -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-green-600 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-feather text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Caboclas</h3>

        <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase">
            Sabedoria & Cura
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Entidades de luz que trazem a força feminina da natureza, atuando na cura,
            proteção, orientação e equilíbrio espiritual dentro da Umbanda.
        </p>

        <button class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg"
            onclick="document.getElementById('caboclas').showModal()">
            Ler mais
        </button>
    </div>
</div>
<!-- CARDS -->

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-pink-500 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-pink-100 text-pink-500 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-child-reaching text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Crianças</h3>
        <p class="text-sm text-pink-600 font-semibold text-center mb-6 uppercase">Alegria & Pureza</p>
        <p class="text-gray-600 text-justify mb-4">
            Entidades infantis que trazem leveza, cura e renovação espiritual, 
            manifestando-se com alegria e sabedoria pura para ajudar nos terreiros.
        </p>
        <button class="mt-4 w-full bg-pink-500 text-white py-2 rounded-lg" 
		onclick="document.getElementById('criancas').showModal()">
		Ler mais
		</button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-red-600 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-skull-crossbones text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Exu Mirim</h3>
        <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase">Desenrolo & Proteção</p>
        <p class="text-gray-600 text-justify mb-4">
            Entidades jovens e encantadas que atuam desfazendo magias negativas, limpando caminhos e revelando forças ocultas.
            São irreverentes, rápidos e especialistas em “desenrolar” a vida.
        </p>
        <button class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg" 
		onclick="document.getElementById('exumirim').showModal()">
		Ler mais
		</button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-red-700 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-fire-flame-curved text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Exu</h3>
        <p class="text-sm text-red-700 font-semibold text-center mb-6 uppercase">Guarda & Caminhos</p>
        <p class="text-gray-600 text-justify mb-4">
            Exus são guardiões, mensageiros e protetores da Umbanda. Trabalham abrindo caminhos, desfazendo demandas e conduzindo energias com precisão.
        </p>
        <button class="mt-4 w-full bg-red-700 text-white py-2 rounded-lg" 
		onclick="document.getElementById('exu').showModal()">
		Ler mais
		</button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-blue-600 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-water text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Janaína</h3>
        <p class="text-sm text-blue-600 font-semibold text-center mb-6 uppercase">Força das Águas</p>
        <p class="text-gray-600 text-justify mb-4">
            A Linha de Janaína manifesta a força das águas, com Iemanjá, Cabocla Janaína e Erê Janaína atuando em cura, sensibilidade e orientação amorosa.
        </p>
        <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg" 
		onclick="document.getElementById('janaina').showModal()">
		Ler mais
		</button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-blue-800 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-800 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-anchor text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Marinheiros</h3>
        <p class="text-sm text-blue-800 font-semibold text-center mb-6 uppercase">Força do Mar</p>
        <p class="text-gray-600 text-justify mb-4">
            Espíritos que trabalharam nos mares e hoje atuam na Umbanda com descarrego, equilíbrio emocional e limpeza profunda, sob a força de Iemanjá.
        </p>
        <button class="mt-4 w-full bg-blue-800 text-white py-2 rounded-lg" 
		onclick="document.getElementById('marinheiros').showModal()">
		Ler mais
        </button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-red-700 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-shield-halved text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Ogum</h3>
        <p class="text-sm text-red-700 font-semibold text-center mb-6 uppercase">Força & Lei</p>
        <p class="text-gray-600 text-justify mb-4">
            Orixá da coragem, da guerra, do ferro e dos caminhos. Ogum abre estradas, afasta demandas e fortalece seus filhos com determinação e proteção.
        </p>
        <button class="mt-4 w-full bg-red-700 text-white py-2 rounded-lg" 
		onclick="document.getElementById('ogum').showModal()">
		Ler mais
		</button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-rose-700 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-rose-100 text-rose-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-chess-queen text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Pombagira</h3>

        <p class="text-sm text-rose-700 font-semibold text-center mb-6 uppercase">
            Poder & Transmutação
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Pombagiras são entidades da esquerda que atuam com transmutação, autoestima,
            equilíbrio emocional e quebra de demandas. Trabalham ao lado dos Exus,
            auxiliando na libertação, transformação e melhoria de vida.
        </p>

        <button class="mt-4 w-full bg-rose-700 text-white py-2 rounded-lg" 
		onclick="document.getElementById('pombagira').showModal()">
        Ler mais
        </button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-blue-700 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-landmark text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Oriente / Mongóis</h3>

        <p class="text-sm text-blue-700 font-semibold text-center mb-6 uppercase">
            Sabedoria & Cura
        </p>

        <p class="text-gray-600 text-justify mb-4">
            A Linha do Oriente reúne espíritos sábios de várias culturas que atuam na cura,
            no conhecimento ancestral e no combate às demandas. A falange dos Mongóis faz
            parte dessa linha, trazendo força guerreira e visão estratégica.
        </p>

        <button class="mt-4 w-full bg-blue-700 text-white py-2 rounded-lg"
            onclick="document.getElementById('oriente').showModal()">
            Ler mais
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-blue-700 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-sun text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Oriente</h3>

        <p class="text-sm text-blue-700 font-semibold text-center mb-6 uppercase">
            Sabedoria & Iluminação
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Reúne espíritos sábios de povos antigos — hindus, egípcios, maias, árabes,
            celtas e muitos outros — que atuam com cura energética, equilíbrio interior
            e evolução espiritual.
        </p>

        <button class="mt-4 w-full bg-blue-700 text-white py-2 rounded-lg"
            onclick="document.getElementById('orientecompleta').showModal()">
            Ler mais
        </button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-green-700 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-feather-pointed text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Caboclos</h3>

        <p class="text-sm text-green-700 font-semibold text-center mb-6 uppercase">
            Cura & Sabedoria Ancestral
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Espíritos de grande força e sabedoria ligados à natureza, que atuam na cura,
            no aconselhamento e na elevação espiritual, sempre transmitindo equilíbrio,
            coragem e humildade.
        </p>

        <button class="mt-4 w-full bg-green-700 text-white py-2 rounded-lg"
            onclick="document.getElementById('caboclos').showModal()">
            Ler mais
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-red-800 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-800 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-gun text-2xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Cangaceiros</h3>

        <p class="text-sm text-red-800 font-semibold text-center mb-6 uppercase">
            Justiça & Bravura
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Entidades valentes e justas que trazem a força, coragem e resistência do sertão.
            Combatem injustiças, protegem e ensinam a vencer desafios com fé e determinação.
        </p>

        <button class="mt-4 w-full bg-red-800 text-white py-2 rounded-lg"
            onclick="document.getElementById('cangaceiros').showModal()">
            Ler mais
        </button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-green-700 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-leaf text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Encantados</h3>

        <p class="text-sm text-green-700 font-semibold text-center mb-6 uppercase">
            Natureza & Mistério
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Espíritos naturais que não morrem, mas se encantam, habitando matas,
            rios e mares. São seres de sabedoria profunda e grande poder espiritual.
        </p>

        <button class="mt-4 w-full bg-green-650 text-white py-2 rounded-lg"
            onclick="document.getElementById('encantados').showModal()">
            Ler mais
        </button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-amber-800 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-800 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-cross text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Freis</h3>

        <p class="text-sm text-amber-800 font-semibold text-center mb-6 uppercase">
            Caridade & Cura
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Entidades como freis, frades e padres que irradiam amor, cura,
            humildade e compaixão. Trabalham na transformação espiritual e
            na proteção da natureza e dos animais.
        </p>

        <button class="mt-4 w-full bg-amber-800 text-white py-2 rounded-lg"
            onclick="document.getElementById('freis').showModal()">
            Ler mais
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-neutral-800 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-neutral-200 text-neutral-800 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-pipe-smoking text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Pretos Velhos</h3>

        <p class="text-sm text-neutral-800 font-semibold text-center mb-6 uppercase">
            Sabedoria & Humildade
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Ancestrais espirituais que se manifestam com amor, paciência e fé,
            oferecendo cura, aconselhamento e profunda sabedoria através de
            benzimentos e ervas.
        </p>

        <button class="mt-4 w-full bg-neutral-800 text-white py-2 rounded-lg"
            onclick="document.getElementById('pretos').showModal()">
            Ler mais
        </button>
    </div>
</div>



<!-- AREA DE MODAIS-->

<!-- Caboclo Vigia -->
<x-modal-premium 
    id="vigia" 
    title="Caboclo Vigia" 
    subtitle="Guardião da Vigilância • Sabedoria Ancestral" 
    icon="fa-solid fa-eye" 
    headerGradient="linear-gradient(135deg, #166534 0%, #14532d 100%)"
>
    <p>O Caboclo Vigia é um espírito da linha dos caboclos na Umbanda, representantes da força da natureza e da sabedoria ancestral indígena. Guardião das florestas, ele atua como protetor, vigilante e guia espiritual para aqueles que buscam equilíbrio, cura e conhecimento.</p>
    <p>Representa Oxalá dentro da linha de Oxóssi, sendo responsável por levar os pedidos de ambos. Durante sua última encarnação, foi um grande guerreiro e líder da tribo Arapuins, no Amazonas. Mesmo após seu desencarne em 1789, continua zelando pela mata, pelo seu povo e por todos que respeitam a natureza.</p>
    
    <h3 class="text-xl font-bold text-green-800">Origem e Missão</h3>
    <p>O Caboclo Vigia é um espírito ancestral profundamente ligado aos povos originários. Sua principal função é <strong>vigiar</strong>: proteger a natureza, equilibrar forças espirituais e orientar os consulentes. Por ser um caboclo muito velho espiritualmente, carrega grande sabedoria e conhecimento ancestral.</p>

    <h3 class="text-xl font-bold text-green-800">Características</h3>
    <p>Forte, direto e sábio, o Caboclo Vigia é conhecido por sua postura firme e disciplinada. Seus conselhos são objetivos e cheios de amor paternal, inspirando força, ordem, determinação e responsabilidade espiritual.</p>

    <h3 class="text-xl font-bold text-green-800">Homenagens</h3>
    <ul class="list-disc pl-6 space-y-1">
        <li>Frutas Tropicais</li>
        <li>Milho e Coco</li>
        <li>Mel e Vinho Tinto</li>
        <li>Ervas Medicinais</li>
    </ul>
</x-modal-premium>

<!-- Linha das Bruxas -->
<x-modal-premium 
    id="bruxas" 
    title="Linha das Bruxas" 
    subtitle="Magia Ancestral • Transformação Energética" 
    icon="fa-solid fa-hat-wizard" 
    headerGradient="linear-gradient(135deg, #581c87 0%, #3b0764 100%)"
>
    <p>A Linha das Bruxas na Umbanda é uma falange espiritual composta por bruxos, bruxas, feiticeiras, magos e magas que trabalham diretamente com a manipulação das energias naturais. Embora seja uma linha rara e não encontrada em muitos terreiros, possui forte ligação com a magia ancestral e com práticas energéticas profundas.</p>
    <p>Apesar de popularmente associada à magia negativa, dentro da Umbanda essa linha atua sempre para o bem, mesmo quando lida com pedidos que envolvem desmanches, cortes de demandas ou limpezas espirituais profundas.</p>

    <h3 class="text-xl font-bold text-purple-800">Função e Trabalho</h3>
    <p>A Linha das Bruxas atua na manipulação das energias da natureza, na magia, na limpeza profunda, no afastamento de negatividades e na restauração da harmonia espiritual. Trabalham com “mistérios”, elementos naturais, ervas, fogo, água, minerais e correntes energéticas sutis.</p>

    <h3 class="text-xl font-bold text-purple-800">Regência</h3>
    <p>A regência não é única — a Linha das Bruxas é conduzida por um colegiado espiritual, composto por espíritos elevados como São Bento, São Lázaro, São Roque e São Cipriano.</p>
</x-modal-premium>

<!-- Linha da Pombagira Mirim -->
<x-modal-premium 
    id="mirim" 
    title="Pombagira Mirim" 
    subtitle="Pureza e Força da Esquerda" 
    icon="fa-solid fa-child" 
    headerGradient="linear-gradient(135deg, #e11d48 0%, #9f1239 100%)"
>
    <p>A Linha da Pombagira Mirim na Umbanda representa entidades espirituais com energia jovem, alegre, travessa e extremamente protetora. Elas trabalham na esquerda ao lado dos Exus Mirins, mas possuem uma vibração mais leve e infantil, apesar de igualmente poderosa.</p>
    <p>Essas entidades têm a missão de desfazer “nós” energéticos, revelar intenções ocultas, cortar negatividades e trazer alegria, abertura de caminhos e espontaneidade para quem as busca.</p>

    <h3 class="text-xl font-bold text-rose-800">Funções Principais</h3>
    <ul class="list-disc pl-6 space-y-1">
        <li>Desfazer trabalhos negativos e demandas complexas.</li>
        <li>Simplificar situações complicadas (“desenrolar a vida”).</li>
        <li>Proteger contra más intenções e influências espirituais ruins.</li>
        <li>Revelar a verdadeira face das pessoas e ambientes.</li>
    </ul>

    <h3 class="text-xl font-bold text-rose-800">Rituais</h3>
    <p>Suas oferendas costumam incluir doces coloridos, balas, suspiros, cocadas e refrigerantes. As cores são vibrantes e a energia é de celebração e proteção constante.</p>
</x-modal-premium>

<!-- Linha das Almas -->
<x-modal-premium 
    id="almas" 
    title="Linha das Almas" 
    subtitle="Mistério, Elevação e Transição" 
    icon="fa-solid fa-skull" 
    headerGradient="linear-gradient(135deg, #334155 0%, #0f172a 100%)"
>
    <p>A Linha das Almas na Umbanda é composta por espíritos dedicados ao resgate, auxílio e encaminhamento de almas recém-desencarnadas, conduzindo-as aos planos espirituais superiores. É uma linha séria, sábia e profundamente ligada ao processo de transição entre a vida e a morte.</p>
    <p>Suas entidades trabalham para ajudar espíritos que ainda estão presos à matéria, ao sofrimento ou à confusão pós-desencarne. Pretos Velhos, Caboclos, crianças, Exus e Pombagiras podem atuar nessa linha sob a regência de Obaluaiyê, Omulu e Nanã.</p>

    <h3 class="text-xl font-bold text-slate-800">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
        <li><strong>Missão:</strong> Encaminhamento de espíritos sofredores para hospitais e escolas espirituais.</li>
        <li><strong>Sapiência:</strong> Espíritos antigos e experientes com alto grau de evolução.</li>
        <li><strong>Cura:</strong> Atuam na cura de doenças da alma e na transmutação de energias densas.</li>
    </ul>
</x-modal-premium>

<!-- Linha das Ondinas -->
<x-modal-premium 
    id="ondinas" 
    title="Linha das Ondinas" 
    subtitle="Força das Águas • Purificação Emocional" 
    icon="fa-solid fa-water" 
    headerGradient="linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%)"
>
    <p>Na Umbanda, as Ondinas são entidades elementais da água, vinculadas à Linha das Sereias e regidas principalmente por Iemanjá e Oxum. Manifestam-se com aparências variadas — desde belas sereias até guerreiras aquáticas — atuando especialmente no campo emocional, energético e na proteção espiritual.</p>
    <h3 class="text-xl font-bold text-blue-800">Trabalho Espiritual</h3>
    <ul class="list-disc pl-6 space-y-1">
        <li>Purificação emocional e cura de traumas afetivos.</li>
        <li>Equilíbrio da autoestima e cuidado com crianças.</li>
        <li>Auxílio nos processos de fertilidade e renovação.</li>
    </ul>
</x-modal-premium>

<!-- Linha das Pretas Velhas -->
<x-modal-premium 
    id="pretas" 
    title="Linha das Pretas Velhas" 
    subtitle="Sabedoria • Humildade • Amor" 
    icon="fa-solid fa-hand-holding-heart" 
    headerGradient="linear-gradient(135deg, #78350f 0%, #451a03 100%)"
>
    <p>As Pretas Velhas são entidades de profunda luz na Umbanda, manifestando-se como anciãs africanas que simbolizam a sabedoria, humildade, resistência e o amor de nossos ancestrais. São espíritos que acolhem, aconselham, curam e ensinam, trazendo paz e equilíbrio espiritual.</p>
    <h3 class="text-xl font-bold text-amber-800">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
        <li><strong>Sabedoria ancestral:</strong> Experiência acumulada de muitas vidas.</li>
        <li><strong>Cura e proteção:</strong> Benzimentos, banhos de ervas e defumações.</li>
        <li><strong>Acolhimento:</strong> Recebem todos como uma avó amorosa.</li>
    </ul>
</x-modal-premium>

<!-- Linha das Sereias -->
<x-modal-premium 
    id="sereias" 
    title="Linha das Sereias" 
    subtitle="Mistério das Águas • Encanto e Purificação" 
    icon="fa-solid fa-fish" 
    headerGradient="linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)"
>
    <p>As Sereias são seres naturais, forças elementais da água que trazem limpeza, purificação e harmonização espiritual. Atuam sobre emoções, pensamentos e vibrações, utilizando seus cantos sagrados para dissolver negatividades.</p>
    <h3 class="text-xl font-bold text-cyan-800">Função</h3>
    <p>Realizam purificação e descarga de energias negativas com grande intensidade, sendo excelentes para neutralizar magias negativas e curar ambientes.</p>
</x-modal-premium>

<!-- Linha dos Baianos -->
<dialog id='baianos' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-yellow-700">Linha dos Baianos na Umbanda</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Baianos é composta por entidades espirituais alegres, fortes e trabalhadoras,
      conhecidas pela energia de movimentação, pela habilidade em desmanchar magias negativas
      e pela capacidade de abrir caminhos. São espíritos que transmitem coragem,
      fé e determinação, sempre com alegria e descontração.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-yellow-700">Características e Funções</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li><strong>Energia e alegria:</strong> São espíritos extrovertidos, brincalhões e cheios de vida, trazendo leveza aos trabalhos.</li>
      <li><strong>Trabalho espiritual:</strong> Atuam com forte energia de movimentação, semelhante à vibração de Iansã, sendo excelentes em descarrego e quebra de demandas.</li>
      <li><strong>Abertura de caminhos:</strong> Trabalham especialmente na abertura de caminhos para prosperidade, trabalho e realização pessoal.</li>
      <li><strong>Orientação e conselho:</strong> São ótimos conselheiros, oferecendo respostas diretas e práticas para problemas cotidianos.</li>
      <li><strong>Ligação com a Bahia:</strong> Representam a força cultural da Bahia, estado que acolheu o culto aos Orixás e preservou tradições afro-brasileiras.</li>
      <li><strong>Integração com outras linhas:</strong> Frequentemente trabalham em harmonia com Caboclos, Marinheiros, Exus e outras falanges.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-yellow-700">Manifestações e Aparência</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li><strong>Vestimentas:</strong> Podem usar chapéu de palha ou de couro, roupas simples e coloridas, lembrando o povo do sertão ou até cangaceiros.</li>
      <li><strong>Sotaque nordestino:</strong> Muitos se manifestam com o sotaque típico da Bahia e do Nordeste.</li>
      <li><strong>Comidas e bebidas:</strong> Apreciam comidas típicas como vatapá, caruru, feijão fradinho e acarajé, além de água de coco e bebidas leves.</li>
      <li><strong>Guias e elementos:</strong> Usam guias de coquinho, olho de cabra e outros elementos fortes do Nordeste.</li>
    </ul>

    <p class="italic text-yellow-700 font-semibold">
      “Saravá a Bahia! Saravá a Linha dos Baianos! Que eles abram nossos caminhos com força e alegria!”
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('baianos').close()"
            class="px-6 py-2 bg-yellow-700 text-white rounded-lg hover:bg-yellow-800">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Boiadeiro -->
<dialog id='boiadeiros' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-amber-800">Linha de Boiadeiro</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha de Boiadeiro é formada por espíritos de vaqueiros, cangaceiros, capatazes,
      posseiros e trabalhadores do campo. São espíritos experientes, corajosos e resolutos,
      que encontraram na caridade um caminho para evoluir espiritualmente, atuando
      incorporados na Umbanda.
    </p>

    <p>
      Embora façam parte da Linha de Caboclos, diferenciam-se bastante em função, forma de
      trabalho e energia. São espíritos mais “recentes”, que viveram em épocas onde já existiam
      tecnologias como ferro, armas de fogo, montaria estruturada e técnicas de magia terrena.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-amber-800">Características dos Boiadeiros</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li><strong>Incorporação:</strong> Possuem incorporação firme, rude e rápida, com gestos fortes e vibratórios.</li>
      <li><strong>Função principal:</strong> Trabalham com consultas e passes, mas não dão receitas de ervas como os caboclos. Sua especialidade é o “dispersar de energias” aderidas a pessoas, objetos e ambientes.</li>
      <li><strong>Limpeza energética:</strong> Estão sempre atentos a movimentações espirituais. Quando bradam forte, estão ordenando que espíritos intrusos se retirem, limpando o ambiente.</li>
      <li><strong>Disciplina:</strong> Mantêm a ordem dentro do terreiro, zelando pela disciplina de médiuns e consulentes.</li>
      <li><strong>Proteção:</strong> São grandes protetores de seus médiuns, defendendo-os contra ataques espirituais e até físicos.</li>
      <li><strong>Lealdade:</strong> Para um boiadeiro considerar alguém seu “filho”, exige coragem, honestidade e lealdade real.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-amber-800">Trabalho Espiritual</h3>
    <p>
      Mesmo quando atuam para diferentes Orixás, como Ogum ou Oxóssi, suas formas de trabalho
      permanecem praticamente as mesmas. A vibração do Orixá é um direcionamento interno, mas
      todos são considerados braços de Omulu, o grande regente da cura e da transformação.
    </p>

    <p>
      Há grande diversidade dentro da linha: existem boiadeiros jovens e idosos,
      boiadeiros do Nordeste, do Sul, do Centro-Oeste, entre outras regiões espirituais
      que representam suas últimas vivências encarnadas.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-amber-800">Entrega de Boiadeiro</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li>Farofa de carne seca</li>
      <li>1 lata de cerveja</li>
      <li>1 charuto</li>
      <li>1 caixa de fósforos</li>
      <li>7 velas brancas</li>
    </ul>

    <p class="italic font-semibold text-amber-800">
      “Êh Boiadeiro! Que sua coragem, disciplina e força sigam abrindo nossos caminhos!”
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('boiadeiros').close()"
            class="px-6 py-2 bg-amber-800 text-white rounded-lg hover:bg-amber-900">
      Fechar
    </button>
  </div>
</dialog>


<!-- Linha de Caboclas -->
<dialog id='caboclas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-green-800">Linha de Caboclas na Umbanda</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      As Caboclas na Umbanda são entidades espirituais de luz que se manifestam 
      incorporadas em médiuns para auxiliar os consulentes, orientar, curar e 
      proteger os terreiros. Representam a força, a sabedoria e a pureza dos 
      povos originários, trazendo firmeza, paz e determinação.
    </p>

    <p>
      Cada Cabocla possui uma vibração própria, podendo estar associada a 
      diversos Orixás, como Iemanjá, Oxum, Iansã, Nanã, Oiá, Egunitá e Obá, 
      expressando uma rica diversidade energética dentro da Linha das Matas.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-800">Caracterização e Função</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li>
        <strong>Representação:</strong> Geralmente apresentadas como guerreiras indígenas,
        mas sua verdadeira forma espiritual carrega a essência e sabedoria dos 
        povos originários.
      </li>

      <li>
        <strong>Atuação em cura:</strong> Utilizam conhecimentos de ervas, raízes, 
        defumações e passes energéticos para limpeza e restauração emocional 
        e espiritual.
      </li>

      <li>
        <strong>Proteção:</strong> Zelam pela ordem do terreiro, mantendo harmonia, 
        disciplina e afastando energias negativas.
      </li>

      <li>
        <strong>Orientação:</strong> Oferecem conselhos diretos e sábios, sempre 
        equilibrados pela paciência e determinação.
      </li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-green-800">Nomes e Vibrações</h3>

    <p>
      Os nomes das Caboclas variam e muitas vezes indicam sua origem ou sua 
      energia vibracional. Essas vibrações podem não corresponder ao orixá de 
      coroa do médium incorporado.
    </p>

    <ul class="list-disc pl-6 space-y-2">
      <li><strong>Cabocla da Mata:</strong> Ligada à força da natureza, podendo vibrar em diferentes orixás.</li>
      <li><strong>Cabocla Jurema:</strong> Uma das mais populares, associada à energia de Iansã.</li>
      <li><strong>Cabocla Estrela-do-Mar:</strong> Relacionada à vibração de Iemanjá, com energia serena.</li>
      <li>
        <strong>Vibração cruzada:</strong> Uma Cabocla de Ogum pode se manifestar num médium filho 
        de Oxóssi, absorvendo a energia deste sem perder sua essência.
      </li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-green-800">Rituais e Oferendas</h3>

    <ul class="list-disc pl-6 space-y-2">
      <li>
        <strong>Oferendas:</strong> Frutas, coco, mel, milho, gengibre, azeite, canela, 
        cravo-da-índia, açúcar cristal, açúcar mascavo e noz-moscada.
      </li>
      <li>
        <strong>Bebida:</strong> A gengibirra é tradicionalmente a bebida preferida de muitas Caboclas.
      </li>
      <li>
        <strong>Cores:</strong> Verde é a cor predominante, mas também utilizam amarelo, azul e vermelho.
      </li>
    </ul>

    <p class="italic font-semibold text-green-800">
      "Saravá as Caboclas! Guerreiras da luz, da mata e dos ventos sagrados!"
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('caboclas').close()"
            class="px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-900">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Crianças -->
<x-modal-premium 
    id="criancas" 
    title="Linha das Crianças" 
    subtitle="Alegria, Pureza e Renovação" 
    icon="fa-solid fa-child-reaching" 
    headerGradient="linear-gradient(135deg, #db2777 0%, #9d174d 100%)"
>
    <p>A Linha das Crianças (Ibeji, Erês) traz a energia da alegria pura. Atuam na limpeza de tristezas, medos e angústias, renovando as esperanças e a leveza espiritual.</p>
    <h3 class="text-xl font-bold text-pink-800">Atuação</h3>
    <p>Utilizam elementos simples como doces e brincadeiras para promover curas emocionais profundas e desobstruir caminhos estagnados.</p>
</x-modal-premium>

<!-- Linha de Exu Mirim -->
<x-modal-premium 
    id="exumirim" 
    title="Linha de Exu Mirim" 
    subtitle="Desenrolo e Proteção de Esquerda" 
    icon="fa-solid fa-skull-crossbones" 
    headerGradient="linear-gradient(135deg, #dc2626 0%, #991b1b 100%)"
>
    <p>Exu Mirim é uma força de transformação rápida. Atuam desfazendo demandas, magias negativas e "nós" que impedem o progresso material e espiritual.</p>
    <h3 class="text-xl font-bold text-red-800">Missão</h3>
    <p>Apesar da irreverência, são guardiões poderosos que revelam intenções ocultas e promovem limpezas astrais pesadas.</p>
</x-modal-premium>

<!-- Linha de Exu -->
<x-modal-premium 
    id="exu" 
    title="Linha de Exu" 
    subtitle="Guardião dos Caminhos" 
    icon="fa-solid fa-fire-flame-curved" 
    headerGradient="linear-gradient(135deg, #7f1d1d 0%, #450a0a 100%)"
>
    <p>Os Exus são os grandes guardiões e mensageiros. Atuam na proteção dos terreiros, na abertura de caminhos e no desmanche de magias negativas, mantendo o equilíbrio entre os planos.</p>
    <h3 class="text-xl font-bold text-red-900">Função</h3>
    <p>São os executores da lei espiritual na terra, resolvendo problemas práticos e afastando influências densas com disciplina e foco.</p>
</x-modal-premium>

<!-- Linha de Janaína -->
<!-- Linha de Janaína -->
<x-modal-premium 
    id="janaina" 
    title="Linha de Janaína" 
    subtitle="Força e Mistério das Águas" 
    icon="fa-solid fa-water" 
    headerGradient="linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%)"
>
    <p>Reúne a força de Iemanjá e das caboclas das águas. Atua com grande sensibilidade, promovendo o acolhimento maternal e a cura emocional profunda para todos os aflitos.</p>
</x-modal-premium>

<!-- Linha dos Marinheiros -->
<x-modal-premium 
    id="marinheiros" 
    title="Linha dos Marinheiros" 
    subtitle="Equilíbrio nas Ondas da Vida" 
    icon="fa-solid fa-anchor" 
    headerGradient="linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%)"
>
    <p>Espíritos que trabalham com o elemento água para o descarrego e a limpeza profunda. O seu balanço simboliza o movimento constante da vida e a superação das tempestades emocionais.</p>
</x-modal-premium>

<!-- Linha de Ogum -->
<x-modal-premium 
    id="ogum" 
    title="Linha de Ogum" 
    subtitle="Vencedor de Demandas • Caminhos e Lei" 
    icon="fa-solid fa-shield-halved" 
    headerGradient="linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%)"
>
    <p>Ogum é o Orixá da coragem e da ordem. Suas falanges atuam na linha de frente, protegendo os filhos contra investidas negativas e abrindo as estradas para o sucesso e a paz.</p>
</x-modal-premium>

<!-- Linha de Pombagira -->
<x-modal-premium 
    id="pombagira" 
    title="Linha de Pombagira" 
    subtitle="Empoderamento e Transmutação" 
    icon="fa-solid fa-chess-queen" 
    headerGradient="linear-gradient(135deg, #be123c 0%, #881337 100%)"
>
    <p>As Pombagiras atuam no equilíbrio das emoções, na autoestima e na transmutação de baixas vibrações em força pessoal. São guardiãs poderosas da liberdade e da alegria de viver.</p>
</x-modal-premium>

<!-- Linha do Oriente - Composição -->
<x-modal-premium id="oriente" title="Oriente / Mongóis" subtitle="Sabedoria Ancestral e Estratégia" icon="fa-solid fa-landmark" headerGradient="linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%)">
    <p>Reúne espíritos sábios que trazem conhecimentos de cura, estratégia e justiça de antigas civilizações. Atuam na iluminação mental e no combate a demandas intelectuais e espirituais.</p>
</x-modal-premium>

<!-- Linha do Oriente Completa -->
<x-modal-premium id="orientecompleta" title="Linha do Oriente" subtitle="Iluminação e Cura Universal" icon="fa-solid fa-sun" headerGradient="linear-gradient(135deg, #ca8a04 0%, #a16207 100%)">
    <p>Formada por mestres, médicos e filósofos de diversas culturas antigas. Focam na evolução espiritual, expansão da consciência e equilíbrio energético através da paz e meditação.</p>
</x-modal-premium>

<!-- Linha dos Caboclos -->
<x-modal-premium id="caboclos" title="Linha dos Caboclos" subtitle="Força das Matas e Sabedoria" icon="fa-solid fa-feather-pointed" headerGradient="linear-gradient(135deg, #15803d 0%, #166534 100%)">
    <p>Guerreiros da luz que utilizam a força da natureza para a caridade. Mestres no uso das ervas e nos passes de limpeza, trazem firmeza e paciência para os desafios diários.</p>
</x-modal-premium>

<!-- Linha dos Cangaceiros -->
<x-modal-premium id="cangaceiros" title="Linha dos Cangaceiros" subtitle="Justiça e Bravura do Sertão" icon="fa-solid fa-gun" headerGradient="linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%)">
    <p>Entidades que representam a resistência e a honra. Atuam contra injustiças e opressões, fortalecendo a vontade e a coragem daqueles que lutam por seus direitos e ideais.</p>
</x-modal-premium>

<!-- Linha dos Encantados -->
<x-modal-premium id="encantados" title="Linha dos Encantados" subtitle="Mistérios da Natureza Viva" icon="fa-solid fa-leaf" headerGradient="linear-gradient(135deg, #15803d 0%, #166534 100%)">
    <p>Seres da natureza que transitam entre os mundos. Ensinam o respeito à todas as formas de vida e o equilíbrio com os elementos fundamentais da criação.</p>
</x-modal-premium>

<!-- Linha dos Freis -->
<x-modal-premium id="freis" title="Linha dos Freis" subtitle="Humildade, Caridade e Oração" icon="fa-solid fa-cross" headerGradient="linear-gradient(135deg, #78350f 0%, #451a03 100%)">
    <p>Trabalham sob a luz de São Francisco, irradiando amor e compaixão. Atuam especialmente na desobsessão e na cura espiritual pelo poder da fé e da oração sincera.</p>
</x-modal-premium>

<!-- Linha dos Pretos Velhos -->
<x-modal-premium id="pretos" title="Linha dos Pretos-Velhos" subtitle="Paciência, Amor e Redenção" icon="fa-solid fa-pipe-smoking" headerGradient="linear-gradient(135deg, #1f2937 0%, #111827 100%)">
    <p>Os grandes mestres da Umbanda. Com humildade e paciência, oferecem os conselhos mais profundos e as curas mais ternas através de seus benzimentos e sabedoria infinita.</p>
</x-modal-premium>

    </div>
@endsection
