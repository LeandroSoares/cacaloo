@extends('layouts.user')

@section('content')
    <div class="py-12">
       <!-- Cards das Linhas da Umbanda - Mesmo Layout das Lendas -->
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
            <p class="text-gray-600 text-justify mb-4">Caboclo Vigia é um espírito ancestral das matas, guardião da natureza e representante de Oxalá na linha de Oxóssi. Guerreiro sábio e disciplinado, líder da tribo Arapuins no Amazonas até seu desencarne em 1789, continua protegendo seu povo, a floresta e todos que nela buscam cura e equilíbrio. Sua missão é vigiar e manter a ordem espiritual, trazendo conselhos diretos e carregados de conhecimento ancestral. É um caboclo que mais escuta do que fala, e quando fala transmite o amor e a firmeza de um grande Pai. Oferendas comuns: frutas, milho, coco, mel, vinho tinto e ervas.</p>
            <button class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg" onclick="openModal('vigia')">Ler mais</button>
        </div>
    </div>

    <!-- A Linha das Bruxas na Umbanda é formada por espíritos de bruxos, bruxas, feiticeiras, magos e magas que atuam na manipulação das energias naturais. É uma falange rara, presente em poucos terreiros, ligada à magia ancestral e à alta magia. Embora muitos associem essa linha ao lado negativo, sua atuação dentro da Umbanda é sempre voltada ao bem, mesmo quando lida com demandas pesadas. Trabalham manipulação energética profunda, rituais naturais e transmutação. São regidos por um colegiado de espíritos elevados como São Bento, São Lázaro, São Roque e São Cipriano. Na cultura popular, fala-se da Rainha das Bruxas e hierarquias antigas. Em tradições externas, relaciona-se com covens, sacerdotisas e lideranças mágicas. Dentro da Umbanda, essa linha surgiu em giras de Xangô comandadas pelo Caboclo Sete Montanhas e atua com grande força espiritual e sabedoria.</p>
            <button class="mt-4 w-full bg-purple-600 text-white py-2 rounded-lg" onclick="openModal('bruxas')">Ler mais</button>
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
            <button class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg" onclick="openModal('mirim')">Ler mais</button>
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
            <button class="mt-4 w-full bg-gray-700 text-white py-2 rounded-lg" onclick="openModal('almas')">Ler mais</button>
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
            <button class="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg" onclick="openModal('ondinas')">Ler mais</button>
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
            <button class="mt-4 w-full bg-amber-700 text-white py-2 rounded-lg" onclick="openModal('pretas')">Ler mais</button>
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
            <button class="mt-4 w-full bg-cyan-600 text-white py-2 rounded-lg" onclick="openModal('sereias')">Ler mais</button>
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
            <button class="mt-4 w-full bg-yellow-600 text-white py-2 rounded-lg" onclick="openModal('baianos')">Ler mais</button>
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
            <button class="mt-4 w-full bg-orange-600 text-white py-2 rounded-lg" onclick="openModal('boiadeiros')">Ler mais</button>
        </div>
    </div>

<!-- Caboclo Vigia -->
<dialog id="vigia" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-green-700">Caboclo Vigia</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p>Caboclo Vigia é um espírito ancestral das matas, guardião da natureza e representante de Oxalá na linha de Oxóssi. Guerreiro sábio e disciplinado, líder da tribo Arapuins no Amazonas até seu desencarne em 1789, continua protegendo seu povo, a floresta e todos que nela buscam cura e equilíbrio.</p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Origem e missão</h3>
    <p>A função principal é vigiar: proteger o equilíbrio da natureza, identificar desequilíbrios espirituais e guiar consulentes em busca de cura e sabedoria. Traz consigo saber ancestral.</p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Características</h3>
    <p>Visto como guerreiro forte e direto, inspira força, determinação e disciplina em quem o procura com fé.</p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Ligação com a natureza</h3>
    <p>Habita a mata, utiliza plantas, animais e águas em seus trabalhos e ensina a ordem espiritual e material dos espaços.</p>

    <h3 class="text-xl font-semibold mt-4 text-green-700">Homenagem</h3>
    <p>Oferendas: frutas, milho, coco, mel, vinho tinto e ervas. Pontos de força e respeito atraem sua energia protetora.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('vigia').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha das Bruxas -->
<dialog id="bruxas" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-purple-700">Linha das Bruxas</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p>A Linha das Bruxas na Umbanda é formada por espíritos de bruxos, bruxas, feiticeiras, magos e magas que atuam na manipulação das energias naturais. É uma falange rara, presente em poucos terreiros, ligada à magia ancestral e à alta magia. Embora muitos associem essa linha ao lado negativo, sua atuação dentro da Umbanda é sempre voltada ao bem, mesmo quando lida com demandas pesadas.</p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Composição e trabalho</h3>
    <p>Trabalham manipulação energética profunda, rituais naturais e transmutação. Regidos por um colegiado de espíritos elevados como São Bento, São Lázaro, São Roque e São Cipriano.</p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Origem</h3>
    <p>Possuem origens diversas; a prática aparece mais associada à alta magia e tradições antigas. Na Umbanda, essa linha foi fortalecida em giras de Xangô comandadas por Caboclo Sete Montanhas.</p>

    <h3 class="text-xl font-semibold mt-4 text-purple-700">Observações</h3>
    <p>Apesar da imagem popular e literária (Rainha das Bruxas, covens etc.), na Umbanda a linha atua com propósito terapêutico e de proteção, sempre orientada pela ética do terreiro.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('bruxas').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Pombagira Mirim -->
<dialog id="mirim" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-red-600">Linha da Pomba Gira Mirim</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p>A Linha das Pomba Gira Mirim na Umbanda reúne entidades de energia jovem, brincalhona e protetora que atuam na linha da esquerda, muitas vezes em conjunto com os Exus Mirins. Embora mantenham a leveza própria da infância espiritual, possuem grande força para desfazer nós, revelar intenções negativas e trazer alegria e equilíbrio emocional.</p>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Características</h3>
    <ul class="list-disc pl-6 space-y-2">
      <li><strong>Energia:</strong> Juvenil, lúdica e vibrante, porém poderosa.</li>
      <li><strong>Função:</strong> Desfazer trabalhos e desbloquear situações ("desenrolar").</li>
      <li><strong>Atuação:</strong> Trabalham sobre intenções e vínculos energéticos; auxiliam em temas afetivos quando a intenção é positiva.</li>
      <li><strong>Diferença Mirim x Adulto:</strong> Mirim = leveza; Adulto = força e sensualidade.</li>
    </ul>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Rituais e oferendas</h3>
    <p>Oferendas típicas: doces (balas, cocadas, suspiros), refrigerantes, brinquedos, flores como rosas e cravos. Pontos e orações refletem sua personalidade alegre e protetora.</p>

    <h3 class="text-xl font-semibold mt-4 text-red-600">Observações</h3>
    <p>A atuação varia conforme o terreiro. Trabalhos com essa linha devem priorizar proteção, responsabilidade espiritual e respeito às regras da casa.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('mirim').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha das Almas (placeholder) -->
<dialog id="almas" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-gray-700">Linha das Almas</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole aqui o texto completo da "Linha das Almas" e eu atualizo o modal com formatação e subtítulos.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('almas').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha das Ondinas (placeholder) -->
<dialog id="ondinas" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-blue-600">Linha das Ondinas</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole aqui o texto completo da "Linha das Ondinas" quando quiser.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('ondinas').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha das Pretas Velhas (placeholder) -->
<dialog id="pretas" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-amber-700">Linha das Pretas Velhas</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole aqui o texto completo da "Linha das Pretas Velhas" e eu monto o modal com títulos e listas.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('pretas').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha das Sereias (placeholder) -->
<dialog id="sereias" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-cyan-600">Linha das Sereias</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole aqui o texto completo da "Linha das Sereias" quando desejar.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('sereias').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha dos Baianos (placeholder) -->
<dialog id="baianos" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-yellow-600">Linha dos Baianos</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole aqui o texto completo da "Linha dos Baianos" para eu formatar o modal.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('baianos').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>

<!-- Linha dos Boiadeiros (placeholder) -->
<dialog id="boiadeiros" class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
  <h2 class="text-3xl font-bold mb-4 text-orange-600">Linha dos Boiadeiros</h2>
  <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">
    <p><em>Conteúdo completo não fornecido ainda.</em></p>
    <p>Cole o texto da "Linha dos Boiadeiros" e atualizo o modal com subtítulos e listas.</p>
  </div>
  <div class="text-center mt-6">
    <button onclick="document.getElementById('boiadeiros').close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Fechar</button>
  </div>
</dialog>
    </div>
@endsection
