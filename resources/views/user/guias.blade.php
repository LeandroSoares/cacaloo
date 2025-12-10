@extends('layouts.user')

@section('content')
    <div class="py-12">
<!-- Cards das Linhas da Umbanda -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Caboclo Vigia -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-green-600 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-eye text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Caboclo Vigia</h3>
            <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase">Guardiões da Mata</p>
            <p class="text-gray-600 text-justify mb-4">Caboclo Vigia é um espírito ancestral das matas, guardião da natureza e representante de Oxalá na linha de Oxóssi. </p>
            <button class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg" 
                onclick="document.getElementById('vigia').showModal()">
                Ler mais
            </button>
        </div>
    </div>

 <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-purple-600 h-3"></div>

    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 text-purple-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-hat-wizard text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-center mb-4">Linha das Bruxas</h3>

        <p class="text-sm text-purple-600 font-semibold text-center mb-6 uppercase">
            Magia & Transformação
        </p>

        <p class="text-gray-600 text-justify mb-4">
            Falange rara da Umbanda formada por bruxas, feiticeiras e magos que trabalham
            a manipulação energética e a alta magia sempre voltadas ao equilíbrio e ao bem.
        </p>

        <button class="mt-4 w-full bg-purple-600 text-white py-2 rounded-lg"
            onclick="document.getElementById('bruxas').showModal()">
            Ler mais
        </button>
    </div>
</div>


    <!-- Linha da Pombagira Mirim -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-red-600 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-child text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Pombagira Mirim</h3>
            <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase">Forças da Alegria</p>
            <p class="text-gray-600 text-justify mb-4">Atuam com doçura, alegria e transformação emocional...</p>
            <button class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg" 
                onclick="document.getElementById('mirim').showModal()">
                Ler mais
            </button>
        </div>
    </div>

    <!-- Linha das Almas -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
        <div class="bg-gray-700 h-3"></div>
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 bg-gray-200 text-gray-700 rounded-full mb-6 mx-auto">
                <i class="fa-solid fa-skull text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Linha das Almas</h3>
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
            <h3 class="text-2xl font-bold text-center mb-4">Linha das Ondinas</h3>
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
            <h3 class="text-2xl font-bold text-center mb-4">Linha das Sereias</h3>
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
            <h3 class="text-2xl font-bold text-center mb-4">Linha dos Baianos</h3>
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
            <h3 class="text-2xl font-bold text-center mb-4">Linha dos Boiadeiros</h3>
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

        <h3 class="text-2xl font-bold text-center mb-4">Linha das Caboclas</h3>

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
        <h3 class="text-2xl font-bold text-center mb-4">Linha de Crianças</h3>
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
        <h3 class="text-2xl font-bold text-center mb-4">Linha de Exu Mirim</h3>
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
        <h3 class="text-2xl font-bold text-center mb-4">Linha de Exu</h3>
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
        <h3 class="text-2xl font-bold text-center mb-4">Linha de Janaína</h3>
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
        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Marinheiros</h3>
        <p class="text-sm text-blue-800 font-semibold text-center mb-6 uppercase">Força do Mar</p>
        <p class="text-gray-600 text-justify mb-4">
            Espíritos que trabalharam nos mares e hoje atuam na Umbanda com descarrego, equilíbrio emocional e limpeza profunda, sob a força de Iemanjá.
        </p>
        <button class="mt-4 w-full bg-blue-800 text-white py-2 rounded-lg" 
		onclick="document.getElementById('marinheiros').showModal()">
		Ler mais</button>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition">
    <div class="bg-red-700 h-3"></div>
    <div class="p-8">
        <div class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-shield-halved text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-center mb-4">Linha de Ogum</h3>
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

        <h3 class="text-2xl font-bold text-center mb-4">Linha de Pombagira</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha do Oriente</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha do Oriente</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Caboclos</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Cangaceiros</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Encantados</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Freis</h3>

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

        <h3 class="text-2xl font-bold text-center mb-4">Linha dos Pretos Velhos</h3>

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
<dialog id='vigia' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-green-700">Caboclo Vigia</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      O Caboclo Vigia é um espírito da linha dos caboclos na Umbanda, representantes da força da natureza e da
      sabedoria ancestral indígena. Guardião das florestas, ele atua como protetor, vigilante e guia espiritual
      para aqueles que buscam equilíbrio, cura e conhecimento.
    </p>

    <p>
      Representa Oxalá dentro da linha de Oxóssi, sendo responsável por levar os pedidos de ambos. Durante sua
      última encarnação, foi um grande guerreiro e líder da tribo Arapuins, no Amazonas. Mesmo após seu
      desencarne em 1789, continua zelando pela mata, pelo seu povo e por todos que respeitam a natureza.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Origem e missão</h3>
    <p>
      O Caboclo Vigia é um espírito ancestral profundamente ligado aos povos originários. Sua principal função
      é <strong>vigiar</strong>: proteger a natureza, equilibrar forças espirituais e orientar os consulentes.
      Por ser um caboclo muito velho espiritualmente, carrega grande sabedoria e conhecimento ancestral.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Características</h3>
    <p>
      Forte, direto e sábio, o Caboclo Vigia é conhecido por sua postura firme e disciplinada. Seus conselhos são
      objetivos e cheios de amor paternal, inspirando força, ordem, determinação e responsabilidade espiritual.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Ligação com a natureza</h3>
    <p>
      Sua morada é a mata. Seu trabalho está profundamente conectado às plantas, aos animais, às águas e ao
      equilíbrio natural. Ele utiliza seu conhecimento sobre a floresta para orientar e curar, atuando como
      guardião tanto no plano espiritual quanto no material.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Representação na Umbanda</h3>
    <p>
      Considerado um grande espírito da <strong>Linha das Matas</strong>, manifesta-se através de médiuns para
      transmitir ensinamentos elevados. Associado a Oxalá e Oxóssi, é um caboclo que mais escuta do que fala — e
      quando fala, transmite o carinho e a sabedoria de um grande Pai.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Homenagens e oferendas</h3>
    <p>
      Seus filhos e devotos podem homenageá-lo oferecendo:
    </p>

    <ul class="list-disc pl-6 space-y-1">
      <li>frutas</li>
      <li>milho</li>
      <li>coco</li>
      <li>mel</li>
      <li>vinho tinto</li>
      <li>ervas</li>
    </ul>

    <p>
      Pontos cantados de força, respeito e firmeza são usados para chamar sua energia protetora e sua sabedoria.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('vigia').close()" 
        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
        Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Bruxas -->
<dialog id='bruxas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-purple-700">Linha das Bruxas</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha das Bruxas na Umbanda é uma falange espiritual composta por bruxos, bruxas,
      feiticeiras, magos e magas que trabalham diretamente com a manipulação das energias
      naturais. Embora seja uma linha rara e não encontrada em muitos terreiros, possui forte
      ligação com a magia ancestral e com práticas energéticas profundas.
    </p>

    <p>
      Apesar de popularmente associada à magia negativa, dentro da Umbanda essa linha atua
      sempre para o bem, mesmo quando lida com pedidos que envolvem desmanches, cortes de
      demandas ou limpezas espirituais profundas.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Composição</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Bruxas e bruxos</li>
      <li>Feiticeiras e magos</li>
      <li>Magas e estudiosos da alta magia</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Função e Trabalho</h3>
    <p>
      A Linha das Bruxas atua na manipulação das energias da natureza, na magia,
      na limpeza profunda, no afastamento de negatividades e na restauração da harmonia
      espiritual. Trabalham com “mistérios”, elementos naturais, ervas, fogo, água,
      minerais e correntes energéticas sutis.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Origem</h3>
    <p>
      Os espíritos dessa linha possuem origens variadas, muitas vezes ligados à alta magia,
      tradições antigas, escolas iniciáticas e conhecimentos ocultos. Na Umbanda, seu
      aparecimento foi registrado em giras de Xangô comandadas pelo Caboclo Sete Montanhas.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Regência</h3>
    <p>
      A regência não é única — a Linha das Bruxas é conduzida por um colegiado espiritual,
      composto por espíritos elevados como:
    </p>

    <ul class="list-disc pl-6 space-y-1">
      <li>São Bento</li>
      <li>São Lázaro</li>
      <li>São Roque</li>
      <li>São Cipriano</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Na Cultura Popular e Ficção</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li><strong>Rainha das Bruxas:</strong> a governante da Floresta das Bruxas e mãe de todas.</li>
      <li><strong>Hierarquia:</strong> bruxa padrão, bruxa Tia (mais velha), bruxa Avó (muito antiga e poderosa).</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Outras Tradições Relacionadas</h3>
    <p>
      A Linha das Bruxas dialoga simbolicamente com tradições mágicas em geral:
    </p>

    <ul class="list-disc pl-6 space-y-1">
      <li><strong>Coven:</strong> grupos de bruxas reunidas em rituais.</li>
      <li><strong>Alta Sacerdotisa e Alto Sacerdote:</strong> líderes femininos e masculinos.</li>
      <li><strong>Ialorixá / Babalorixá:</strong> líderes de casas espirituais.</li>
      <li><strong>Iaquequerê:</strong> segunda sacerdotisa na hierarquia.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">A Linha das Bruxas na Umbanda</h3>
    <p>
      Dentro da Umbanda, essa linha é respeitada como uma falange especializada em mistérios e
      manipulação energética profunda, atuando sempre com ética, disciplina e a serviço da luz.
    </p>
  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('bruxas').close()" 
        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
        Fechar
    </button>
  </div>
</dialog>

<!-- Linha da Pombagira Mirim -->
<dialog id='mirim' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-red-600">Linha da Pombagira Mirim</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha da Pombagira Mirim na Umbanda representa entidades espirituais com energia jovem,
      alegre, travessa e extremamente protetora. Elas trabalham na esquerda ao lado dos Exus Mirins,
      mas possuem uma vibração mais leve e infantil, apesar de igualmente poderosa.
    </p>

    <p>
      Essas entidades têm a missão de desfazer “nós” energéticos, revelar intenções ocultas,
      cortar negatividades e trazer alegria, abertura de caminhos e espontaneidade para quem as busca.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Características da Pombagira Mirim</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li><strong>Energia:</strong> Jovial, brincalhona, viva, leve e encantada.</li>
      <li><strong>Personalidade:</strong> Travessas, espertas e rápidas, mas sempre protetoras.</li>
      <li><strong>Força espiritual:</strong> Atuam com grande poder nos trabalhos de esquerda.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Funções</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Desfazer trabalhos negativos e demandas.</li>
      <li>Simplificar situações complicadas (“desenrolar a vida”).</li>
      <li>Revelar intenções negativas de pessoas e ambientes.</li>
      <li>Proteger contra más intenções e influências espirituais ruins.</li>
      <li>Ajudar na realização de desejos quando a intenção é positiva.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Pombagira Mirim x Pombagira Adulta</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li><strong>Pombagira Mirim:</strong> Energia infantil, encantada, leve; muitas nunca encarnaram.</li>
      <li><strong>Pombagira Adulta:</strong> Energia madura, sensual, sábia; trabalha emoções e libertação.</li>
    </ul>

    <p>
      Apesar da alegria e inocência, as Pombagiras Mirins conhecem os mistérios da esquerda e atuam com grande
      precisão espiritual, mas sem a carga emocional das Pombagiras adultas.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Semelhança com os Erês</h3>
    <p>
      São frequentemente comparadas aos Erês, por sua energia infantil e brincalhona. No entanto, suas funções
      são diferentes: enquanto os Erês atuam principalmente no equilíbrio emocional e na pureza, a Pombagira Mirim
      atua dentro da linha da esquerda, lidando com revelações, proteção e cortes energéticos.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Rituais e Oferendas</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li><strong>Oferendas:</strong> Doces coloridos, balas, suspiros, cocadas, refrigerantes.</li>
      <li><strong>Flores:</strong> Rosas, cravos e flores alegres.</li>
      <li><strong>Cores:</strong> Cores vibrantes e infantis.</li>
      <li><strong>Pontos cantados:</strong> Cantos alegres que exaltam sua alegria e proteção.</li>
    </ul>

    <p>
      As oferendas são feitas com elementos alegres e coloridos para acompanhar sua vibração infantil e leve.
    </p>
  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('mirim').close()" 
        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Almas -->
<dialog id='almas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-purple-700">Linha das Almas</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha das Almas na Umbanda é composta por espíritos dedicados ao resgate,
      auxílio e encaminhamento de almas recém-desencarnadas, conduzindo-as aos planos
      espirituais superiores. É uma linha séria, sábia e profundamente ligada ao processo
      de transição entre a vida e a morte.
    </p>

    <p>
      Suas entidades trabalham para ajudar espíritos que ainda estão presos à matéria,
      ao sofrimento ou à confusão pós-desencarne. Pretos Velhos, Caboclos, crianças, Exus
      e Pombagiras podem atuar nessa linha.
    </p>

    <p>
      Seus trabalhos são regidos por poderosos Orixás ligados à transformação, cura e
      transmutação: <strong>Omulu, Nanã e Obaluaiyê</strong>.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Características da Linha das Almas</h3>

    <ul class="list-disc pl-6 space-y-1">
      <li>
        <strong>Função principal:</strong> Resgate e encaminhamento de espíritos
        recém-desencarnados, ajudando-os a se desvincular da matéria e a encontrar
        caminhos de evolução.
      </li>

      <li>
        <strong>Entidades:</strong> Espíritos antigos, experientes e sábios, com grande
        grau de evolução, preparados para lidar com os desafios da transição entre
        planos.
      </li>

      <li>
        <strong>Atuação:</strong> Trabalham na compreensão do processo da vida e da morte,
        auxiliando tanto no momento da desencarnação quanto no retorno à matéria.
      </li>

      <li>
        <strong>Pretos Velhos:</strong> São os principais representantes, trazendo cura,
        conselhos e acolhimento.
      </li>

      <li>
        <strong>Caboclos e crianças:</strong> Podem atuar em funções específicas dentro da linha.
      </li>

      <li>
        <strong>Exus e Pombagiras:</strong> Também trabalham na Linha das Almas, especialmente
        quando se trata de resgate, lei e reintegração espiritual.
      </li>

      <li>
        <strong>Orixás regentes:</strong> Omulu, Nanã e Obaluaiyê, responsáveis pela cura,
        transformação e pelo ciclo da vida e da morte.
      </li>

      <li>
        <strong>Trabalho espiritual:</strong> A Linha das Almas recolhe espíritos perdidos,
        sofredores ou desorientados, encaminhando-os para hospitais espirituais, escolas
        e colônias de aprendizado.
      </li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">A Importância na Umbanda</h3>

    <p>
      A Linha das Almas tem papel essencial dentro da Umbanda, pois atua diretamente no
      processo de evolução espiritual dos desencarnados, ajudando-os a superar o apego à
      matéria.
    </p>

    <p>
      É uma linha de amor, cura profunda, acolhimento e transmutação.
    </p>
  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('almas').close()"
            class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Ondinas -->
<dialog id='ondinas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-blue-700">Linha das Ondinas na Umbanda</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      Na Umbanda, as Ondinas são entidades elementais da água, vinculadas à Linha das
      Sereias e regidas principalmente por <strong>Iemanjá</strong> e <strong>Oxum</strong>.
      Manifestam-se com aparências variadas — desde belas sereias até guerreiras
      aquáticas — atuando especialmente no campo emocional, energético e na proteção
      espiritual.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-blue-700">Características e Trabalho Espiritual</h3>

    <ul class="list-disc pl-6 space-y-1">
      <li>
        <strong>Origem:</strong> São seres elementais ligados à água, semelhantes às
        ninfas e espíritos aquáticos presentes na mitologia e alquimia.
      </li>

      <li>
        <strong>Regência:</strong> Trabalham sob a Linha das Águas, regida por Iemanjá,
        Oxum e, em alguns casos, Nanã.
      </li>

      <li>
        <strong>Manifestação:</strong> Podem surgir como seres de natureza aquática,
        com cauda de sereia, ou como espíritos femininos ligados ao movimento das águas.
      </li>

      <li>
        <strong>Trabalho espiritual:</strong> Atuam na purificação emocional, cura de
        traumas afetivos, equilíbrio da autoestima, cuidado com crianças e auxílio nos
        processos de fertilidade.
      </li>

      <li>
        <strong>Aparência:</strong> Variam entre figuras tranquilas e delicadas e
        guerreiras das ondas, irradiando força e serenidade.
      </li>

      <li>
        <strong>Cores:</strong> Azul claro, branco (Iemanjá), amarelo e dourado (Oxum).
      </li>

      <li>
        <strong>Oferendas:</strong> Flores, conchas, espelhos, perfumes, mel e itens
        que remetam ao mar ou às águas doces.
      </li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-blue-700">Relação com os Elementos</h3>

    <ul class="list-disc pl-6 space-y-1">
      <li>
        <strong>Água:</strong> Elemento primordial das Ondinas, representa purificação,
        emoção, intuição e acolhimento.
      </li>

      <li>
        <strong>Desequilíbrio:</strong> A poluição das águas e o desequilíbrio emocional
        humano afetam diretamente a força dessas entidades.
      </li>

      <li>
        <strong>Saúde espiritual:</strong> Ondinas também podem ser afetadas por
        vibrações densas — semelhante ao estado emocional dos médiuns e consulentes.
      </li>

      <li>
        <strong>Ambiente:</strong> São entidades extremamente sensíveis à limpeza.
        Ambientes sujos, caóticos ou desorganizados dificultam sua manifestação.
      </li>
    </ul>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('ondinas').close()"
            class="px-6 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Pretas Velhas -->
<dialog id='pretas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-amber-800">Linha das Pretas Velhas na Umbanda</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      As Pretas Velhas são entidades de profunda luz na Umbanda, manifestando-se como
      anciãs africanas que simbolizam a sabedoria, humildade, resistência e o amor de
      nossos ancestrais que viveram os tempos da escravidão no Brasil. 
      São espíritos que acolhem, aconselham, curam e ensinam, trazendo paz e equilíbrio
      espiritual aos consulentes.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-amber-800">Características e Ensinamentos</h3>

    <ul class="list-disc pl-6 space-y-2">

      <li>
        <strong>Sabedoria ancestral:</strong>
        Representam a experiência acumulada de muitas vidas, inclusive a vivência da escravidão,
        oferecendo conselhos com paciência, calma e doçura.
      </li>

      <li>
        <strong>Humildade e generosidade:</strong>
        Inspiram fé, perdão, esperança e amor ao próximo, mostrando a força da simplicidade.
      </li>

      <li>
        <strong>Cura e proteção:</strong>
        Trabalham com benzimentos, banhos de ervas, defumações e outras “mirongas” para curar
        dores emocionais, espirituais e afastar energias negativas.
      </li>

      <li>
        <strong>Símbolos e representações:</strong>
        São retratadas com bengalas, cachimbos, terços, rosários, saias longas e panos na cabeça,
        fumando ervas para limpar o ambiente.
      </li>

      <li>
        <strong>Acolhimento:</strong>
        Recebem todos como uma avó amorosa, com compreensão, carinho e proteção.
      </li>

    </ul>

    <h3 class="text-xl font-semibold mt-4 text-amber-800">Como se Conectar</h3>

    <ul class="list-disc pl-6 space-y-2">

      <li>
        <strong>Com o coração aberto:</strong>
        A conexão acontece por meio da humildade, escuta atenta e entrega de fé.
      </li>

      <li>
        <strong>Oferendas:</strong>
        Gostam de café preto, chá, bolo de fubá, fumo e, sobretudo, da gratidão sincera.
      </li>

      <li>
        <strong>Rituais:</strong>
        A ligação com a Preta Velha é fortalecida em orações, firmezas e trabalhos espirituais
        conduzidos com respeito e devoção.
      </li>

    </ul>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('pretas').close()"
            class="px-6 py-2 bg-amber-800 text-white rounded-lg hover:bg-amber-900">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha das Sereias -->
<dialog id='sereias' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-cyan-700">Linha das Sereias na Umbanda</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      As Sereias são seres naturais, espíritos que nunca encarnaram e que atuam como forças
      elementais da água, trazendo limpeza, purificação e harmonização espiritual. 
      Elas pertencem ao mistério “Sereia” da Umbanda Sagrada e trabalham com grande poder 
      energético, atuando sobre emoções, pensamentos e vibrações.
    </p>

    <h3 class="text-xl font-semibold mt-4 text-cyan-700">Regência Espiritual</h3>

    <ul class="list-disc pl-6 space-y-2">

      <li><strong>Sereias (atuais):</strong> Regidas por Yemanjá, são seres naturais puramente aquáticos.</li>

      <li><strong>Ondinas ou antigas sereias:</strong> Mais velhas e profundas, regidas por Nanã Buruquê.</li>

      <li><strong>Encantadas elementais aquáticas:</strong> Regidas por Oxum, de vibração doce e amorosa.</li>

    </ul>

    <p>
      As três mães d'água — Yemanjá, Oxum e Nanã — regem todo o mistério das sereias.
      Embora incorporem com os cantos de Yemanjá, podem responder igualmente a cânticos
      de Oxum e Nanã, dançando de forma mais rápida (Oxum) ou mais lenta (Nanã).
    </p>

    <h3 class="text-xl font-semibold mt-4 text-cyan-700">Natureza e Função</h3>

    <ul class="list-disc pl-6 space-y-2">

      <li>
        <strong>Seres naturais:</strong>
        Como nunca encarnaram, são classificadas como espíritos da natureza e possuem
        forte poder energético.
      </li>

      <li>
        <strong>Poder de limpeza:</strong>
        Realizam purificação e descarga de energias negativas com grande intensidade.
      </li>

      <li>
        <strong>Comunicação:</strong>
        Não falam; emitem um canto lamuriento, que é na verdade um “mantra aquático”
        capaz de dissolver formas-pensamento, cargas emocionais e miasmas espirituais.
      </li>

      <li>
        <strong>Atuação:</strong>
        São excelentes para neutralizar magias negativas, afastar obsessores e curar
        ambientes, famílias e relações.
      </li>

      <li>
        <strong>Pouco solicitadas:</strong>
        Embora muito poderosas, são raramente chamadas para trabalhos de natureza,
        mas deveriam ser mais estudadas e utilizadas pelos umbandistas.
      </li>

    </ul>

    <h3 class="text-xl font-semibold mt-4 text-cyan-700">Oferendas</h3>

    <p>Devem ser levadas ao mar, rios, lagos ou cachoeiras:</p>

    <ul class="list-disc pl-6 space-y-2">
      <li>Rosas brancas</li>
      <li>Velas brancas, azuis, amarelas e lilases</li>
      <li>Champanhe</li>
      <li>Frutas em calda</li>
      <li>Licores</li>
    </ul>

    <p class="italic text-cyan-700 font-semibold">
      Salve as Sereias! Que suas águas limpem, curem e tragam harmonia a todos nós.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('sereias').close()"
            class="px-6 py-2 bg-cyan-700 text-white rounded-lg hover:bg-cyan-800">
      Fechar
    </button>
  </div>
</dialog>

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
<dialog id='criancas' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-pink-600">Linha das Crianças</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha das Crianças na Umbanda, também chamada de Ibejis, Erês ou Ibeijada, 
      representa espíritos infantis que trazem alegria, pureza, leveza e renovação espiritual.
      Suas manifestações são docemente infantis, mas carregam profunda sabedoria.
    </p>

    <p>
      Esses espíritos atuam na cura emocional, no equilíbrio energético, na limpeza de tristezas, 
      medos e angústias, utilizando elementos simples como doces, guaraná e brincadeiras simbólicas.
    </p>

    <h3 class="text-xl font-semibold text-pink-600">Características e Funções</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Alegria e leveza no terreiro</li>
      <li>Sabedoria pura e mensagens diretas</li>
      <li>Purificação emocional por meio de doces e energias infantis</li>
      <li>Atuam como mensageiros dos Orixás</li>
      <li>Manifestam-se com personalidades diversas (choronas, manhosas, travessas, agitadas)</li>
    </ul>

    <h3 class="text-xl font-semibold text-pink-600">Simbologia e Conexões</h3>
    <p>
      São associados a São Cosme e Damião e a figuras infantis do imaginário brasileiro.
      Representam a pureza espiritual e a alegria divina.
    </p>

    <h3 class="text-xl font-semibold text-pink-600">Como Interagir</h3>
    <p>
      Basta abrir o coração, se permitir brincar, sorrir e aceitar doces — ações simbólicas 
      que facilitam a limpeza espiritual promovida pelos Erês.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('criancas').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Exu Mirim -->
<dialog id='mirim' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-red-600">Linha de Exu Mirim</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha de Exu Mirim é uma linha da esquerda na Umbanda composta por entidades 
      que se manifestam como crianças ou adolescentes espirituais, muitas vezes irreverentes e travessas.
      Representam forças de transformação rápida, quebra de demandas e “desenrolos”.
    </p>

    <p>
      Apesar da aparência infantil, possuem profundo conhecimento das energias negativas e sabem 
      desfazer amarrações, magias e bloqueios, restaurando o equilíbrio astral.
    </p>

    <h3 class="text-xl font-semibold text-red-600">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Trabalham desfazendo demandas e magias negativas</li>
      <li>Personalidade travessa, irreverente e sincera</li>
      <li>Podem ser espíritos encarnados ou encantados</li>
      <li>Ajudam a ativar força pessoal e coragem</li>
      <li>Promovem limpezas espirituais profundas</li>
    </ul>

    <h3 class="text-xl font-semibold text-red-600">Simbologia</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Cores: preto e vermelho</li>
      <li>Saudação: <strong>Laroyê Exu Mirim!</strong></li>
    </ul>

    <p>
      São extremamente eficazes quando trabalhados com doutrina e respeito, apesar de serem alvo de preconceito.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('exu-mirim').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Exu -->
<dialog id='exu' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-red-700">Linha de Exu</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha de Exu na Umbanda é composta por espíritos guardiões que atuam 
      como mensageiros dos Orixás, protetores, abridores de caminhos e 
      responsáveis por desfazer demandas espirituais.
    </p>

    <p>
      Diferente da visão distorcida popular, Exu é um espírito de luz na Umbanda, 
      disciplinado e atuante na manutenção da ordem espiritual.
    </p>

    <h3 class="text-xl font-semibold text-red-700">Funções Principais</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Proteção dos terreiros</li>
      <li>Abertura de caminhos</li>
      <li>Desmanche de demandas</li>
      <li>Equilíbrio energético</li>
      <li>Resolução de problemas práticos (trabalho, amor, vida cotidiana)</li>
    </ul>

    <h3 class="text-xl font-semibold text-red-700">Distinções Importantes</h3>
    <p>
      Exu não é quiumba. Quiumbas são espíritos zombeteiros, enquanto Exu é servidor da luz.
      Trabalham com firmeza e foco, mas sempre dentro da lei espiritual.
    </p>

    <h3 class="text-xl font-semibold text-red-700">Oferendas</h3>
    <p>
      Seu principal alimento ritual é o padê, composto por farinha, dendê, marafo e pimenta.
      Cada templo pode ter variações tradicionais.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('exu').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Janaína -->
<dialog id='janaina' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-blue-600">Linha de Janaína</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha de Janaína na Umbanda reúne manifestações espirituais associadas a Iemanjá,
      à Cabocla Janaína e às Erês Janaína. Cada uma expressa uma força diferente 
      ligada às águas, à intuição e ao amor.
    </p>

    <h3 class="text-xl font-semibold text-blue-600">Iemanjá – Rainha do Mar</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Orixá das águas salgadas</li>
      <li>Representação da maternidade e proteção</li>
      <li>Conectada ao amor, calma e equilíbrio</li>
    </ul>

    <h3 class="text-xl font-semibold text-blue-600">Cabocla Janaína</h3>
    <p>
      Guia amorosa, sábia e direta, que atua nas linhas de Iemanjá ou Oxum. 
      Trabalha pela caridade, justiça e proteção.
    </p>

    <h3 class="text-xl font-semibold text-blue-600">Erê Janaína</h3>
    <p>
      Manifestação infantil com grande sensibilidade emocional, ligada às águas e ao amor.
      Apreciam doces, guaraná, bonecas e cores suaves.
    </p>

    <h3 class="text-xl font-semibold text-blue-600">Oferendas</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Rosas, perfumes, espelhos, frutas</li>
      <li>Velas azul-claras e brancas</li>
      <li>Oferendas na beira do rio ou mar</li>
    </ul>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('janaina').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Marinheiros -->
<dialog id='marinheiros' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-blue-700">Linha dos Marinheiros</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Marinheiros na Umbanda é formada por espíritos que em vida foram
      marujos, pescadores, navegadores ou piratas. Trabalham na linha de Iemanjá 
      e atuam em limpeza espiritual, descarrego, equilíbrio emocional e firmeza mediúnica.
    </p>

    <p>
      São conhecidos pelo balanço característico, simbolizando o movimento do mar
      e a oscilação emocional humana.
    </p>

    <h3 class="text-xl font-semibold text-blue-700">Características e Trabalhos</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Descarrego e limpeza profunda</li>
      <li>Quebra de demandas</li>
      <li>Trabalho emocional e sentimental</li>
      <li>Apoio no desenvolvimento mediúnico</li>
      <li>Conexão com a calunga grande (mar)</li>
    </ul>

    <h3 class="text-xl font-semibold text-blue-700">Linha de Piratas</h3>
    <p>
      Trabalham o “porão emocional”, limpando sentimentos esquecidos e trazendo
      à tona potenciais e força interior.
    </p>

    <h3 class="text-xl font-semibold text-blue-700">Aparência</h3>
    <p>
      Podem se apresentar com bandanas, brincos, faixas ou aspecto de marinheiro tradicional,
      dependendo de sua história espiritual.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('marinheiros').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Ogum -->
<dialog id='ogum' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-red-700">Linha de Ogum</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      Ogum na Umbanda é o Orixá da guerra, da lei, do trabalho, da tecnologia e da abertura de caminhos.
      Ele é sincretizado com São Jorge e representa coragem, ordem e determinação.
    </p>

    <p>
      É o grande guerreiro espiritual que combate injustiças, afasta demandas e fortalece 
      aqueles que precisam vencer batalhas internas e externas.
    </p>

    <h3 class="text-xl font-semibold text-red-700">Características e Domínios</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Força, coragem e disciplina</li>
      <li>Estradas, caminhos e encruzilhadas</li>
      <li>Metalurgia, ferro, armas e tecnologia</li>
      <li>Lei, ordem e justiça</li>
    </ul>

    <h3 class="text-xl font-semibold text-red-700">Culto</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Dia: Terça-feira</li>
      <li>Cores: vermelho, azul-marinho ou verde</li>
      <li>Saudação: <strong>Ogum Iê!</strong> / <strong>Patakori Ogum!</strong></li>
      <li>Comidas: inhame assado com dendê, feijão fradinho, cará, feijoada, cerveja branca</li>
    </ul>

    <h3 class="text-xl font-semibold text-red-700">Falanges de Ogum</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Ogum Matinata (Guerreiro)</li>
      <li>Ogum Beira-Mar</li>
      <li>Ogum de Lei</li>
      <li>Ogum Rompe-Mato</li>
      <li>Ogum Megê</li>
      <li>Ogum Sete Espadas</li>
      <li>Ogum Sete Ondas</li>
    </ul>

    <p>
      Seus filhos são valentes, objetivos e intensos, podendo ser impulsivos quando desequilibrados.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('ogum').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha de Pombagira -->
<dialog id='pombagira' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-pink-700">Linha de Pombagira</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      As Pombagiras na Umbanda são guardiãs que trabalham na linha da esquerda ao lado dos Exus.
      Representam poder feminino, independência, autoestima, sensualidade equilibrada e força emocional.
    </p>

    <p>
      Sua atuação é voltada à cura emocional, quebra de demandas, proteção e resolução de conflitos amorosos.
    </p>

    <h3 class="text-xl font-semibold text-pink-700">Exemplos de Linhas</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Pombagiras de Ogum – firmes e protetoras</li>
      <li>Pombagiras de Iansã – fortes e guerreiras</li>
      <li>Pombagiras de Oxum / Iemanjá – ligadas ao amor e à água</li>
      <li>Pombagiras de Omolu – ligadas à cura e ao cemitério</li>
      <li>Pombagiras Ciganas – intuitivas e sábias</li>
    </ul>

    <h3 class="text-xl font-semibold text-pink-700">Trabalhos</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Quebra de demandas e limpezas profundas</li>
      <li>Auxílio no amor, autoestima e relações</li>
      <li>Destrave de padrões emocionais</li>
      <li>Empoderamento pessoal</li>
    </ul>

    <p>
      Apesar do preconceito, são entidades de extrema luz e disciplina dentro da lei maior.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('pombagira').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha do Oriente - Composição -->
<dialog id='oriente' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-amber-600">Linha do Oriente – Composição</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha do Oriente é formada por espíritos sábios de vários povos antigos e tradicionais.
      Dentro dessa linha existe a Falange dos Mongóis, frequentemente mencionada, mas não como linha independente.
    </p>

    <h3 class="text-xl font-semibold text-amber-600">Falanges que a compõem</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Mongóis, chineses e japoneses</li>
      <li>Egípcios</li>
      <li>Indus e árabes</li>
      <li>Ciganos</li>
      <li>Maias, Astecas e Incas</li>
      <li>Europeus sábios e guerreiros</li>
      <li>Médicos, mestres e filósofos</li>
    </ul>

    <h3 class="text-xl font-semibold text-amber-600">Características dos Mongóis</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Trabalhos de cura</li>
      <li>Desmanche de demandas</li>
      <li>Sabedoria xamânica</li>
      <li>Aconselhamento estratégico</li>
    </ul>

    <p>
      Um dos chefes mais conhecidos dessa linha é Pai Ory do Oriente, símbolo de sabedoria e iluminação.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('oriente').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha do Oriente -->
<dialog id='orientecompleta' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-yellow-600">Linha do Oriente</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha do Oriente reúne espíritos sábios de diversas tradições antigas, como egípcios, hindus,
      árabes, celtas, chineses e japoneses. Representam iluminação, cura espiritual e equilíbrio.
    </p>

    <h3 class="text-xl font-semibold text-yellow-600">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Buscam a evolução espiritual e a expansão da consciência</li>
      <li>Atuam com meditação, cura energética e sabedoria ancestral</li>
      <li>Regência de Oxalá e Xangô</li>
      <li>Cores: amarelo, dourado, rosa e branco</li>
    </ul>

    <h3 class="text-xl font-semibold text-yellow-600">Pontos de Culto</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Dia: Quinta-feira</li>
      <li>Essências: alfazema, olibano, sândalo</li>
      <li>Objetos: japamalas, velas coloridas e pedras como citrino</li>
    </ul>

    <p>
      Seus guias são mestres, sábios, monges, médicos e filósofos, que atuam na cura e iluminação.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('orientecompleta').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Caboclos -->
<dialog id='caboclos' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-green-700">Linha dos Caboclos</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Caboclos reúne espíritos de origem indígena ou ligados à força da floresta.
      São curadores, conselheiros e guerreiros espirituais extremamente sábios e fortes.
    </p>

    <p>
      Trabalham com ervas, elementos naturais, passes de cura e orientações espirituais diretas.
    </p>

    <h3 class="text-xl font-semibold text-green-700">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Ligação profunda com a natureza</li>
      <li>Uso de ervas e medicina natural</li>
      <li>Sabedoria ancestral indígena</li>
      <li>Força espiritual e coragem</li>
    </ul>

    <h3 class="text-xl font-semibold text-green-700">Ritos e Oferendas</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Frutas, mel, vinho moscatel, coco</li>
      <li>Ervas fortes como gengibre, cravo e arruda</li>
      <li>Velas verdes, amarelas ou vermelhas</li>
    </ul>

    <p>
      A saudação principal é <strong>“Okê, Caboclo!”</strong>
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('caboclos').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Cangaceiros -->
<dialog id='cangaceiros' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-yellow-700">Linha dos Cangaceiros</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Cangaceiros na Umbanda representa guerreiros espirituais marcados pela bravura,
      justiça e resistência. São espíritos que simbolizam a luta do povo do sertão contra as
      injustiças e dificuldades da vida.
    </p>

    <p>
      Atuam como protetores, fortalecendo seus médiuns e consulentes para superar desafios,
      injustiças e opressões.
    </p>

    <h3 class="text-xl font-semibold text-yellow-700">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Força, coragem e honra</li>
      <li>Proteção contra injustiças</li>
      <li>Espíritos guerreiros e firmes</li>
      <li>Energia do sertão e da resistência</li>
    </ul>

    <h3 class="text-xl font-semibold text-yellow-700">Exemplos de Entidades</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Zé do Cangaço</li>
      <li>Severino</li>
      <li>Maria Bonita</li>
      <li>Maria do Cangaço</li>
      <li>Corisco</li>
      <li>Zé Bacamarte</li>
    </ul>

    <p>
      Sua mensagem central é a luta por justiça, coragem e lealdade.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('cangaceiros').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Encantados -->
<dialog id='encantados' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-teal-700">Linha dos Encantados</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Encantados representa espíritos que não passaram pelo processo tradicional 
      da morte, mas se "encantaram", tornando-se seres que transitam entre o plano físico e espiritual.
    </p>

    <p>
      Habitantes das matas, rios, mares e montanhas, carregam forte ligação com os elementos
      da natureza, atuando com profundo conhecimento energético.
    </p>

    <h3 class="text-xl font-semibold text-teal-700">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Ligação direta com a natureza</li>
      <li>Sabedoria ancestral e intuitiva</li>
      <li>Curas espirituais e limpezas profundas</li>
      <li>Energia alegre ou introspectiva, conforme o elemento</li>
    </ul>

    <h3 class="text-xl font-semibold text-teal-700">Manifestações</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Incorporação em médiuns</li>
      <li>Sonhos e visões</li>
      <li>Presenças sutis na natureza</li>
    </ul>

    <p>
      Os Encantados ensinam respeito à natureza, responsabilidade espiritual e equilíbrio.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('encantados').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Freis -->
<dialog id='freis' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-stone-700">Linha dos Freis</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Freis, também chamada Linha de São Francisco, reúne espíritos como freis,
      padres, frades e freiras que trabalham com cura, caridade, desobsessão e elevação espiritual.
    </p>

    <p>
      A energia dessa linha é marcada pela humildade, amor ao próximo, simplicidade e profunda
      compaixão pelos necessitados.
    </p>

    <h3 class="text-xl font-semibold text-stone-700">Características Principais</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Cura espiritual e física</li>
      <li>Transformação interior</li>
      <li>Proteção da natureza e dos animais</li>
      <li>Caridade e acolhimento</li>
    </ul>

    <h3 class="text-xl font-semibold text-stone-700">Regência</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Oxalá</li>
      <li>Oxum</li>
      <li>Oxóssi</li>
    </ul>

    <p>
      São Francisco de Assis é sincretizado com Xangô, representando equilíbrio, justiça,
      retidão e amor universal.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('freis').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

<!-- Linha dos Pretos-Velhos -->
<dialog id='pretos' class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-gray-800">Linha dos Pretos-Velhos</h2>

  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

    <p>
      A Linha dos Pretos-Velhos representa ancestrais africanos sábios, que viveram como escravizados
      e, após sua evolução espiritual, retornam para auxiliar com amor, humildade e paciência.
    </p>

    <p>
      São considerados grandes conselheiros, curadores e mestres da simplicidade.
    </p>

    <h3 class="text-xl font-semibold text-gray-800">Características</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Humildade e serenidade</li>
      <li>Sabedoria acumulada pela vida dura</li>
      <li>Fala mansa e paciência infinita</li>
      <li>Curas com ervas, benzimentos e defumações</li>
    </ul>

    <h3 class="text-xl font-semibold text-gray-800">Símbolos e Elementos</h3>
    <ul class="list-disc pl-6 space-y-1">
      <li>Cachimbo</li>
      <li>Rosário e orações</li>
      <li>Café preto, bolo de fubá e garapa</li>
      <li>Ervas simples e sagradas</li>
    </ul>

    <p>
      Sua data comemorativa é 13 de maio, marcando a abolição da escravatura.
    </p>

  </div>

  <div class="text-center mt-6">
    <button onclick="document.getElementById('pretos').close()" 
      class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
      Fechar
    </button>
  </div>
</dialog>

    </div>
@endsection
