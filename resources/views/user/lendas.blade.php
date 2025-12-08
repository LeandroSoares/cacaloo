@extends('layouts.user')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                    Lendas de Umbanda
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Histórias ancestrais que revelam a sabedoria, os mistérios e a essência dos Orixás.
                    Mergulhe no conhecimento sagrado transmitido através das gerações.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="h-1 w-24 bg-indigo-600 rounded-full"></div>
                </div>
            </div>

<!-- Legends Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Comadre Fulozinha -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-green-600 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Comadre Fulozinha</h3>
            <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase tracking-wide">Guardião da Mata</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Comadre Fulozinha é uma entidade protetora da mata, descrita como uma jovem de longos cabelos negros que protege a natureza.</p>
                <p>Era uma índia perdida na floresta que morreu e passou a cuidar das árvores e animais.</p>
                <p>Pune caçadores e lenhadores desrespeitosos, mas protege quem respeita a mata.</p>
            </div>
        </div>
    </div>

    <!-- Iara -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-blue-500 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Iara – Mãe D’Água</h3>
            <p class="text-sm text-blue-600 font-semibold text-center mb-6 uppercase tracking-wide">Sereia dos Rios</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Iara é uma sereia amazônica de beleza encantadora e canto hipnótico.</p>
                <p>Antigamente uma índia guerreira, foi transformada em sereia após ser lançada ao rio pelo pai.</p>
                <p>Atraí homens com seu canto ou protege animais e rios, dependendo da versão.</p>
            </div>
        </div>
    </div>

    <!-- Mula Sem Cabeça -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-red-700 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Mula Sem Cabeça</h3>
            <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase tracking-wide">A Maldição Flamejante</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Uma mulher amaldiçoada por se envolver com um padre transforma-se em uma mula flamejante sem cabeça.</p>
                <p>Corre durante a madrugada relinchando de forma aterrorizante.</p>
                <p>Retorna à forma humana quando o galo canta pela terceira vez.</p>
            </div>
        </div>
    </div>

    <!-- Vitória-Régia -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-purple-600 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Vitória-Régia</h3>
            <p class="text-sm text-purple-600 font-semibold text-center mb-6 uppercase tracking-wide">A Estrela das Águas</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Naiá, uma jovem índia apaixonada pela Lua, acreditava que poderia tocar Jaci nas águas.</p>
                <p>Mergulhou tentando alcançar o reflexo lunar e se afogou.</p>
                <p>Foi transformada na vitória-régia, cuja flor abre à noite.</p>
            </div>
        </div>
    </div>

    <!-- Boitatá -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-orange-600 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Boitatá</h3>
            <p class="text-sm text-orange-600 font-semibold text-center mb-6 uppercase tracking-wide">A Cobra de Fogo</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Boitatá é uma serpente de fogo que protege florestas contra incêndios e destruição.</p>
                <p>Seus olhos brilham intensamente, assustando invasores.</p>
                <p>Pode se transformar em uma chama errante.</p>
            </div>
        </div>
    </div>

    <!-- Boto Cor-de-Rosa -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-pink-500 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Boto Cor-de-Rosa</h3>
            <p class="text-sm text-pink-600 font-semibold text-center mb-6 uppercase tracking-wide">O Encantador</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>O boto se transforma em um homem elegante nas noites de festa.</p>
                <p>Usa chapéu para esconder sua narina de boto.</p>
                <p>Seduz mulheres e retorna ao rio antes do amanhecer.</p>
            </div>
        </div>
    </div>

    <!-- Caboclo D’Água -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-cyan-600 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Caboclo D’Água</h3>
            <p class="text-sm text-cyan-600 font-semibold text-center mb-6 uppercase tracking-wide">Guardião dos Rios</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Espírito que vive no fundo dos rios, podendo virar barcos e assustar pescadores.</p>
                <p>Pescadores usam carrancas e estrelas para afastá-lo.</p>
                <p>Em algumas versões guarda uma gruta de ouro.</p>
            </div>
        </div>
    </div>

    <!-- Caipora -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-emerald-600 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Caipora</h3>
            <p class="text-sm text-emerald-600 font-semibold text-center mb-6 uppercase tracking-wide">Protetora da Floresta</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Protetora das matas e animais, pune caçadores que matam além do necessário.</p>
                <p>Pode aparecer como índia de cabelos vermelhos ou ser peludo montado em porco-do-mato.</p>
                <p>Aceita fumo e álcool como oferendas.</p>
            </div>
        </div>
    </div>

    <!-- Cuca -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-yellow-700 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Cuca</h3>
            <p class="text-sm text-yellow-700 font-semibold text-center mb-6 uppercase tracking-wide">A Bruxa</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Bruxa aterrorizante, com cabeça de jacaré, rouba crianças desobedientes.</p>
                <p>Dorme apenas uma vez a cada sete anos.</p>
                <p>Faz poções em sua caverna.</p>
            </div>
        </div>
    </div>

    <!-- Curupira -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-red-500 h-3"></div>
        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Curupira</h3>
            <p class="text-sm text-red-500 font-semibold text-center mb-6 uppercase tracking-wide">Protetor dos Animais</p>
            <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                <p>Menino de cabelos vermelhos e pés virados para trás, protetor da floresta.</p>
                <p>Confunde caçadores com truques e ilusões.</p>
                <p>Uma das lendas mais antigas do Brasil.</p>
            </div>
        </div>
    </div>

</div>
<!-- Lobisomem -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <div class="bg-gray-700 h-3"></div>
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Lobisomem</h3>
        <p class="text-sm text-gray-700 font-semibold text-center mb-6 uppercase tracking-wide">A Maldição da Lua Cheia</p>
        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
            <p>A lenda do lobisomem conta sobre um homem que se transforma em uma criatura metade homem, metade lobo durante as noites de lua cheia.</p>
            <p>No Brasil, acredita-se que a maldição recai sobre o sétimo ou oitavo filho homem de uma família.</p>
            <p>Diz-se que o lobisomem precisa visitar sete cemitérios antes do amanhecer para recuperar sua forma humana.</p>
        </div>
    </div>
</div>

<!-- Negrinho do Pastoreio -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <div class="bg-indigo-700 h-3"></div>
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Negrinho do Pastoreio</h3>
        <p class="text-sm text-indigo-700 font-semibold text-center mb-6 uppercase tracking-wide">O Protetor dos Perdidos</p>
        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
            <p>A história fala de um menino escravizado que foi injustamente punido e abandonado em um formigueiro.</p>
            <p>Milagrosamente salvo pela Virgem Maria, tornou-se um espírito que ajuda pessoas a encontrarem objetos perdidos.</p>
            <p>Para pedir sua ajuda, basta acender uma vela ao ar livre e repetir: “Foi por aí que eu perdi...”.</p>
        </div>
    </div>
</div>

<!-- Saci-Pererê -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <div class="bg-red-800 h-3"></div>
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Saci-Pererê</h3>
        <p class="text-sm text-red-700 font-semibold text-center mb-6 uppercase tracking-wide">O Travesso do Redemoinho</p>
        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
            <p>Saci-Pererê é um menino de uma perna só, travesso e brincalhão, famoso por fazer tranças na crina dos cavalos.</p>
            <p>Ele aparece em redemoinhos, prega peças e esconde objetos dos moradores.</p>
            <p>Algumas explicações científicas atribuem as tranças à ação de morcegos ou corujas.</p>
        </div>
    </div>
</div>
<!-- Footer Quote -->
            <div class="mt-16 text-center">
                <blockquote class="text-xl italic text-gray-500 font-serif">
                    "As lendas não são apenas histórias do passado, são espelhos onde vemos nossa própria alma e o caminho
                    para o divino."
                </blockquote>
            </div>

        </div>
    </div>
@endsection
