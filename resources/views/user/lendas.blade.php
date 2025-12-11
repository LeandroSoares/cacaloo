@extends('layouts.user')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                    Lendas do Folclore Brasileiro
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    O folclore brasileiro é um rico conjunto de mitos, lendas, danças, músicas, festas e costumes populares que refletem a identidade cultural do Brasil, nascido da miscigenação das culturas indígena, africana e europeia, transmitidos de geração em geração, com personagens famosos como Saci-Pererê, Curupira, Iara e Boitatá, celebrados anualmente no Dia do Folclore em 22 de agosto
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="h-1 w-24 bg-indigo-600 rounded-full"></div>
                </div>
            </div>

<!-- Legends Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

<!-- CARD - COMADRE FULOZINHA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-green-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-leaf text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Comadre Fulozinha</h3>
        <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase tracking-wide">Guardiã da Mata</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Entidade do folclore nordestino que protege as matas, Comadre Fulozinha aparece como uma jovem de
            longos cabelos negros que pode ser brincalhona ou vingativa. Ajuda quem respeita a natureza e pune
            quem agride a floresta.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalFulozinha').showModal()"
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - COMADRE FULOZINHA -->
<dialog id="modalFulozinha"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
    
    <h2 class="text-3xl font-bold mb-4 text-green-700">Lenda da Comadre Fulozinha</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>A lenda da Comadre Fulozinha é uma figura do folclore nordestino que protege a mata, descrita como
        uma entidade feminina com longos cabelos negros, que pode ser tanto brincalhona quanto vingativa.</p>

        <p>As histórias mais populares contam que ela era uma índia que se perdeu na floresta e morreu,
        passando a proteger a natureza após um encontro com as árvores. Ela prega peças em quem desrespeita
        a floresta, como lenhadores e caçadores, mas também ajuda aqueles que a respeitam, que por isso lhe
        deixam oferendas como fumo ou mel.</p>

        <p><strong>Origem:</strong> Existem diferentes versões sobre sua origem, mas uma das mais comuns é a
        de uma menina ou índia que se perdeu na mata e morreu. A lenda diz que ela vive na floresta para
        proteger as árvores e os animais.</p>

        <p><strong>Aparência:</strong> É descrita como uma jovem com longos cabelos negros, pintada com tinta
        nos olhos e adornada com folhas e ramos.</p>

        <p><strong>Comportamento:</strong> Seu comportamento é ambíguo: ela pode ser amiga dos animais e pregar
        peças neles, mas também pode ser severa com humanos que desrespeitam a natureza. Para se proteger de
        sua fúria, as pessoas deixam oferendas de fumo, mel ou comida em troncos de árvores.</p>

        <p><strong>Poderes:</strong> Ela é conhecida por sua agilidade e inteligência, e pode confundir quem
        entra na mata sem licença, fazendo barulhos estranhos e tranças nos cavalos.</p>

        <p><strong>Variações:</strong> Em algumas regiões, ela é conhecida como “Flor do Mato” ou “Mãe da Mata”.
        A lenda também é cultuada em algumas religiões como a Jurema Sagrada.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalFulozinha').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>

</dialog>
<!-- CARD - IARA (MÃE D'ÁGUA) -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-blue-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-water text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Iara – Mãe D’Água</h3>
        <p class="text-sm text-blue-600 font-semibold text-center mb-6 uppercase tracking-wide">A Senhora dos Rios</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Linda sereia dos rios amazônicos, Iara possui um canto irresistível que encanta e atrai os homens
            para o fundo das águas. Protetora dos rios e da vida aquática, ela é ao mesmo tempo sedutora e
            temida.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalIara').showModal()"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - IARA -->
<dialog id="modalIara"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
    
    <h2 class="text-3xl font-bold mb-4 text-blue-700">Lenda da Iara – Mãe D’Água</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>A lenda da Iara, também conhecida como Mãe-d'Água, conta a história de uma linda sereia do folclore
        brasileiro que vive nos rios, principalmente na Amazônia.</p>

        <p>Sua origem é a de uma índia guerreira que, após fugir de seus irmãos ciumentos, foi jogada em um rio
        pelo próprio pai, sendo salva pelos peixes e transformada em sereia pela lua cheia. Com seu canto e
        beleza hipnotizantes, ela atrai homens para o fundo d'água, onde eles desaparecem para sempre.</p>

        <h3 class="text-xl font-semibold mt-4 text-blue-700">A origem da lenda</h3>

        <p><strong>Origem indígena:</strong> A versão mais conhecida descreve Iara como uma índia guerreira,
        filha de um pajé, admirada por sua coragem e beleza.</p>

        <p><strong>Fuga e transformação:</strong> Após matar seus irmãos em legítima defesa, fugiu para a mata.
        Encontrada por seu pai, foi jogada no rio como castigo. Os peixes a salvaram, e na noite de lua cheia,
        ela foi transformada em sereia.</p>

        <p><strong>Origem europeia:</strong> Algumas versões apontam influências europeias, misturando crenças
        indígenas com mitologias trazidas pelos colonizadores.</p>

        <h3 class="text-xl font-semibold mt-4 text-blue-700">A lenda na prática</h3>

        <p><strong>Atração mortal:</strong> Iara encanta os homens com sua beleza e canto irresistível,
        atraindo-os para as profundezas.</p>

        <p><strong>Salva-vidas dos animais:</strong> Em versões mais brandas, Iara protege os animais e pune
        quem polui ou agride os rios.</p>

        <p><strong>Aparência variada:</strong> Pode ser retratada como sereia loira de olhos claros ou com
        traços indígenas, morena, de cabelos escuros e olhos profundos.</p>

        <h3 class="text-xl font-semibold mt-4 text-blue-700">Como se proteger</h3>

        <p>Para escapar do encanto da Iara, a tradição recomenda fechar os olhos e tapar os ouvidos, evitando
        ouvir seu canto hipnótico.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalIara').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - MULA SEM CABEÇA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-orange-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-horse text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Mula Sem Cabeça</h3>
        <p class="text-sm text-orange-600 font-semibold text-center mb-6 uppercase tracking-wide">A Maldição Flamejante</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Criatura amaldiçoada do folclore brasileiro, a Mula sem Cabeça nasce de uma mulher que sofre uma
            terrível punição, transformando-se em um animal flamejante que galopa e relincha nas noites
            escuras.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalMula').showModal()"
                class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - MULA SEM CABEÇA -->
<dialog id="modalMula"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
    
    <h2 class="text-3xl font-bold mb-4 text-orange-700">Lenda da Mula Sem Cabeça</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>A lenda da Mula sem Cabeça é um mito do folclore brasileiro sobre uma mulher amaldiçoada que se
        transforma em uma mula flamejante sem cabeça.</p>

        <p>A punição vem de um pecado considerado grave, geralmente um relacionamento com um padre. A criatura
        assusta as pessoas com seu relincho estrondoso, o fogo que substitui sua cabeça e os cascos barulhentos
        que ecoam pela mata, especialmente nas noites de quinta para sexta-feira.</p>

        <h3 class="text-xl font-semibold mt-4 text-orange-700">Origem</h3>

        <p>A lenda é frequentemente interpretada como um conto moral da época, criado para reforçar valores
        religiosos e sociais. A maldição recai sobre mulheres que mantinham relações proibidas com sacerdotes.</p>

        <h3 class="text-xl font-semibold mt-4 text-orange-700">Aparência</h3>

        <p>A Mula sem Cabeça é descrita como uma mula preta ou marrom que não possui cabeça, mas sim uma
        tocha de fogo intensa. Seus cascos possuem ferraduras de aço ou prata, ampliando o som de sua
        cavalgada.</p>

        <h3 class="text-xl font-semibold mt-4 text-orange-700">Comportamento</h3>

        <p>Ela galopa de forma descontrolada, solta relinchos que podem ser ouvidos a grandes distâncias e às
        vezes emite gemidos que lembram a voz humana. É vista como um presságio de terror e aviso espiritual.</p>

        <h3 class="text-xl font-semibold mt-4 text-orange-700">Maldição e cura</h3>

        <p>A maldição ocorre nas noites de quinta para sexta-feira. A mulher retorna à forma humana somente
        quando o galo canta pela terceira vez, marcando o fim da transformação.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalMula').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - VITÓRIA-RÉGIA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-purple-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-purple-100 text-purple-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-spa text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Vitória-Régia</h3>
        <p class="text-sm text-purple-600 font-semibold text-center mb-6 uppercase tracking-wide">A Estrela das Águas</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            A índia Naiá se apaixonou pela Lua e, ao tentar alcançá-la refletida na água, acabou se afogando.
            Comovido, Jaci a transformou na vitória-régia, cuja flor se abre à noite como uma estrela sobre os rios.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalVitoriaRegia').showModal()"
                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - VITÓRIA-RÉGIA -->
<dialog id="modalVitoriaRegia"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">
    
    <h2 class="text-3xl font-bold mb-4 text-purple-700">Lenda da Vitória-Régia</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>A lenda da vitória-régia conta a história da índia Naiá, que se apaixonou por Jaci, a Lua, e desejava
        se transformar em estrela para viver ao lado dele no céu.</p>

        <p>Uma noite, ao ver o reflexo da Lua nas águas calmas de um lago, acreditou que Jaci estava ali e se lançou
        para alcançá-lo. Porém, Naiá se afogou, sem conseguir voltar à superfície.</p>

        <p><strong>A índia Naiá:</strong> Era uma jovem cheia de encanto, que nutria amor e devoção pela Lua,
        considerado um deus na mitologia indígena.</p>

        <p><strong>O desejo:</strong> Ela sonhava em tornar-se uma estrela, vivendo para sempre ao lado de Jaci,
        iluminando o céu noturno.</p>

        <p><strong>A tragédia:</strong> Numa noite quente de verão, confundiu o reflexo lunar com a presença do deus
        e mergulhou, acreditando poder alcançá-lo.</p>

        <p><strong>A transformação:</strong> Comovido pelo sacrifício da jovem, Jaci decidiu homenageá-la,
        transformando-a na vitória-régia, uma das mais belas plantas aquáticas.</p>

        <p><strong>O significado:</strong> A flor da vitória-régia, chamada de “estrela das águas”, desabrocha
        à noite, como um sinal de que Naiá finalmente conseguiu brilhar ao lado da Lua.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalVitoriaRegia').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - BOITATÁ -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-red-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-fire text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Boitatá</h3>
        <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase tracking-wide">A Cobra de Fogo</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Serpente de fogo protetora das matas, o Boitatá brilha intensamente e assusta caçadores e
            destruidores da natureza. Seus olhos luminosos e corpo flamejante percorrem as florestas como um
            aviso divino.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalBoitata').showModal()"
                class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - BOITATÁ -->
<dialog id="modalBoitata"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-red-700">Lenda do Boitatá</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>Boitatá é uma lenda do folclore brasileiro, originária do tupi-guarani, que significa “cobra de
        fogo”. A criatura é descrita como uma grande serpente flamejante que protege as florestas e os animais.</p>

        <p>Com olhos luminosos e corpo em chamas, o Boitatá assusta caçadores, lenhadores e invasores que
        ameaçam a natureza. Em algumas versões, ele pode assumir a forma de uma chama errante que confunde
        aqueles que tentam destruir a mata.</p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Origem</h3>
        <p>A lenda tem origem indígena. Seu nome vem de “boi” (cobra) e “tatá” (fogo), simbolizando uma
        entidade espiritual protetora ligada ao fogo sagrado da floresta.</p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Função</h3>
        <p>É considerada guardiã das matas e do meio ambiente, protegendo-os contra incêndios, invasores e
        ações humanas destrutivas.</p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Características</h3>
        <p>Descrito como uma serpente gigantesca com olhos que brilham intensamente, seu corpo é formado por
        chamas vivas que iluminam a noite.</p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Capacidades</h3>
        <p>O Boitatá pode se mover rapidamente como uma chama viva, aparecendo como um fogo que corre pelos
        campos para enganar, espantar e afugentar intrusos.</p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Variações</h3>
        <p>Em versões mais antigas, como na narrativa de Padre Anchieta, aparece como “baetatá”, uma entidade
        aterrorizante que poderia até matar. Outra interpretação associa a lenda ao fenômeno do fogo-fátuo,
        luzes que surgem da decomposição de matéria orgânica em áreas pantanosas.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalBoitata').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - BOTO COR-DE-ROSA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-pink-500 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-pink-100 text-pink-500 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-hat-cowboy text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Boto Cor-de-Rosa</h3>
        <p class="text-sm text-pink-500 font-semibold text-center mb-6 uppercase tracking-wide">O Sedutor das Águas</p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Criatura amazônica capaz de se transformar em um homem elegante durante noites de lua cheia,
            seduz mulheres em festas e desaparece ao amanhecer, retornando ao rio como boto.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalBoto').showModal()"
                class="px-6 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - BOTO COR-DE-ROSA -->
<dialog id="modalBoto"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-pink-600">Lenda do Boto Cor-de-Rosa</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>A lenda do boto cor-de-rosa é uma das mais conhecidas do folclore amazônico. Ela narra a história
        de um boto encantado capaz de assumir a forma de um homem charmoso e sedutor durante noites de lua
        cheia.</p>

        <p>Nessas ocasiões, ele sai do rio, vai até as festas da região, dança, conquista mulheres e as seduz.
        Antes do amanhecer, desaparece e retorna à forma de animal nas águas profundas.</p>

        <h3 class="text-xl font-semibold mt-4 text-pink-600">Transformação</h3>
        <p>O boto se transforma em um homem elegante, geralmente usando roupas brancas e um chapéu para
        esconder a narina no topo da cabeça, um traço que entrega sua verdadeira identidade.</p>

        <h3 class="text-xl font-semibold mt-4 text-pink-600">Objetivo</h3>
        <p>Sua principal intenção é seduzir mulheres para engravidá-las. A lenda costuma ser usada para
        explicar gravidezes em que a identidade do pai é desconhecida ou não revelada.</p>

        <h3 class="text-xl font-semibold mt-4 text-pink-600">O Mistério do Pai</h3>
        <p>Muitas crianças nascidas sem pai reconhecido eram atribuídas ao boto, o que transformou a lenda
        em uma explicação social para essas situações.</p>

        <h3 class="text-xl font-semibold mt-4 text-pink-600">O Retorno ao Rio</h3>
        <p>Ao amanhecer, o homem-boto retorna apressadamente ao rio, reassume sua forma animal e desaparece,
        deixando a mulher sozinha e encantada — ou grávida.</p>

        <h3 class="text-xl font-semibold mt-4 text-pink-600">Consequências</h3>
        <p>Em algumas versões da lenda, o boto é agressivo com homens que se aproximam das mulheres que ele
        deseja. Em outras, aparece como uma entidade protetora dos pescadores.</p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalBoto').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - CABOCLO D'ÁGUA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
    <div class="bg-blue-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-water text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Caboclo D’Água</h3>
        <p class="text-sm text-blue-600 font-semibold text-center mb-6 uppercase tracking-wide">
            Guardião Sombrio dos Rios
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Espírito das águas, conhecido por virar barcos, afogar banhistas e assustar pescadores.
            Tem pele dura e vive nas profundezas dos rios, especialmente no Rio São Francisco.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalCabocloAgua').showModal()"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - CABOCLO D'ÁGUA -->
<dialog id="modalCabocloAgua"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-blue-600">Lenda do Caboclo D’Água</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            A lenda do Caboclo d'Água é uma das mais conhecidas das margens do Rio São Francisco. Ele é
            descrito como um espírito poderoso, protetor e ao mesmo tempo temido, que habita as profundezas
            dos rios e interfere na vida de pescadores, banhistas e navegantes.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-blue-600">Características do Caboclo d'Água</h3>
        <p><strong>Aparência:</strong> É descrito como um ser musculoso, com pele extremamente dura —
        muitas vezes misturada com escamas — o que o torna praticamente impenetrável.</p>

        <p><strong>Habitat:</strong> Vive nas profundezas dos rios, mas pode emergir para as margens,
        especialmente para assustar ou punir quem desrespeita as águas.</p>

        <h3 class="text-xl font-semibold mt-4 text-blue-600">Poderes</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Vira barcos e canoas com facilidade.</li>
            <li>Afoga banhistas que se aproximam demais do seu território.</li>
            <li>Afugenta peixes, prejudicando pescadores.</li>
            <li>Emite ruídos assustadores para aterrorizar navegantes.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-blue-600">Como se proteger</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Pintar estrelas no casco das embarcações.</li>
            <li>Usar carrancas na proa dos barcos para afastar espíritos ruins.</li>
            <li>Oferecer fumo como forma de acalmá-lo.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-blue-600">Outras Histórias</h3>
        <p>
            Em certas versões, o Caboclo d’Água guarda uma gruta repleta de ouro nas profundezas do rio.
            Em pequenas cidades ribeirinhas, ele se tornou símbolo do medo e do respeito às águas.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-blue-600">Variações da Lenda</h3>
        <p>
            Dependendo da região, ele recebe outros nomes, como
            <strong>Bicho-d'Água</strong>, <strong>Negro-d'Água</strong>,
            ou <strong>Moleque-d'Água</strong>.
        </p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalCabocloAgua').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>
</dialog>

<!-- CARD - CAIPORA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-green-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-paw text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Caipora</h3>
        <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase tracking-wide">
            Guardião Protetor das Matas
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Espírito protetor da mata e dos animais. Conhecido por confundir e punir caçadores que tiram da
            floresta mais do que o necessário, garantindo o equilíbrio da vida selvagem.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalCaipora').showModal()"
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - CAIPORA -->
<dialog id="modalCaipora"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-green-600">Lenda do Caipora</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            Caipora é um dos mais importantes espíritos protetores das florestas no folclore brasileiro.
            Seu nome vem do tupi-guarani “caapora”, que significa <strong>“morador do mato”</strong>.
            Ele aparece para proteger a mata e punir quem desrespeita os animais ou caça em excesso.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Origem e Significado</h3>
        <p>
            De raízes indígenas, a lenda do Caipora é considerada por alguns estudiosos uma variação do
            Curupira, compartilhando o papel de defensor da natureza e espírito guardião da floresta.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Função</h3>
        <p>
            A Caipora atua como protetora da fauna e da flora, punindo caçadores que matam animais sem
            necessidade ou por pura maldade. Quando respeitada, protege os viajantes e os animais.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Aparência</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Índia de cabelos avermelhados e orelhas pontudas.</li>
            <li>Anão peludo com pelos verdes.</li>
            <li>Um ser pequeno e peludo que cavalga um queixada (porco-do-mato).</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Poderes e Comportamento</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Prega peças e assusta caçadores que não respeitam a natureza.</li>
            <li>Pode confundir trilhas com ilusões para proteger os animais.</li>
            <li>Aceita oferendas como fumo e cachaça quando o caçador demonstra respeito.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Sinônimos e Variações</h3>
        <p>
            Dependendo da região, é conhecida como <strong>Pai-do-Mato</strong>,
            <strong>Dona-das-Folhas</strong> ou até associada a variantes femininas como a
            <strong>Comadre Fulosinha</strong>.
        </p>

        <p>
            A expressão <strong>“encaiporado”</strong> surgiu do mito, significando alguém vivendo um
            período de azar.
        </p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalCaipora').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>

</dialog>

<!-- CARD - CUCA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-purple-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-purple-100 text-purple-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-hat-wizard text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Cuca</h3>
        <p class="text-sm text-purple-600 font-semibold text-center mb-6 uppercase tracking-wide">
            Bruxa Temível do Folclore
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Bruxa com cabeça de jacaré que rapta crianças desobedientes. Assustadora, poderosa e sempre
            acordada, a Cuca é uma das figuras mais temidas do folclore brasileiro.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalCuca').showModal()"
                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - CUCA -->
<dialog id="modalCuca"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-purple-600">Lenda da Cuca</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            A Cuca é uma das figuras mais assustadoras do folclore brasileiro. Descrita como uma bruxa
            com cabeça de jacaré, tornou-se famosa por raptar crianças desobedientes, especialmente
            aquelas que se recusam a dormir.
        </p>

        <p>
            Sua imagem mais popular se consolidou com Monteiro Lobato, que deu à Cuca características
            marcantes, tornando-a uma das personagens mais temidas pelos pequenos.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-purple-600">Origem da Lenda</h3>
        <p>
            A origem da Cuca vem do folclore ibérico, com figuras como o <strong>Coco</strong> e a
            <strong>Coca</strong>, que assustavam crianças na Espanha e em Portugal. No Brasil, a lenda
            ganhou novas formas ao se misturar com elementos culturais locais.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-purple-600">Aparência</h3>
        <p>
            A Cuca já foi descrita como uma velha bruxa de pele enrugada e cabelos brancos. Porém, a versão
            mais difundida é a da bruxa com rosto de jacaré, cabelos loiros, unhas longas e um sorriso
            sinistro.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-purple-600">Poderes</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Capacidade de se transformar em animais, como coruja e borboleta.</li>
            <li>Magias e feitiços usados para capturar crianças.</li>
            <li>Poder de persuasão e armadilhas mágicas.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-purple-600">Sono e Energia</h3>
        <p>
            Uma das características mais marcantes da Cuca é que ela só dorme <strong>uma vez a cada sete
            anos</strong>. Isso a torna sempre alerta, pronta para capturar crianças desobedientes.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-purple-600">Onde Vive</h3>
        <p>
            A Cuca vive em uma caverna escura, onde passa noites preparando poções, inventando feitiços
            e planejando maneiras de capturar crianças rebeldes.
        </p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalCuca').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>

</dialog>

<!-- CARD - CURUPIRA -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-green-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-shoe-prints text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Curupira</h3>
        <p class="text-sm text-green-600 font-semibold text-center mb-6 uppercase tracking-wide">
            Guardião das Florestas
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Menino de cabelos vermelhos e pés virados para trás, o Curupira é o protetor das matas,
            confundindo caçadores e punindo quem agride a natureza.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalCurupira').showModal()"
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - CURUPIRA -->
<dialog id="modalCurupira"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-green-600">Lenda do Curupira</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            O Curupira é uma das figuras mais tradicionais do folclore brasileiro, conhecido como o grande
            protetor das florestas e dos animais. Sua missão é punir aqueles que caçam em excesso ou
            desrespeitam a natureza.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Aparência e Características</h3>
        <p>
            Ele é descrito como um menino ou anão de cabelos vermelhos — às vezes comparados a chamas —
            dentes afiados e, sobretudo, os <strong>pés virados para trás</strong>. Essa característica
            serve para confundir caçadores, pois suas pegadas indicam a direção oposta.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Função</h3>
        <p>
            Sua função principal é proteger a floresta. Ele pune desmatadores, afugenta caçadores que
            tentam matar mais do que o necessário e combate qualquer ameaça à fauna e à flora.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Habilidades</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Cria caminhos falsos na mata.</li>
            <li>Imita sons de animais para confundir intrusos.</li>
            <li>Produz assobios agudos que desorientam caçadores.</li>
            <li>Usa ilusões para afastar quem ameaça o equilíbrio da floresta.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Origem da Lenda</h3>
        <p>
            A lenda tem origem indígena e o nome pode significar "corpo de menino" ou "coberto de pústulas"
            em tupi. A primeira menção escrita registrada é de 1560, em uma carta do padre José de Anchieta,
            que relatou a crença indígena na figura do Curupira.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-green-600">Fraquezas e Oferendas</h3>
        <p>
            O Curupira pode ser distraído ou agradado com oferendas como comidas especiais. Em algumas
            versões, ele aprecia frutas e pequenos presentes deixados pelos habitantes da floresta.
        </p>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalCurupira').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>

</dialog>

<!-- CARD - LOBISOMEM -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-gray-800 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-gray-200 text-gray-800 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-wolf-pack-battalion text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Lobisomem</h3>
        <p class="text-sm text-gray-700 font-semibold text-center mb-6 uppercase tracking-wide">
            A Maldição da Lua Cheia
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Homem que se transforma em fera durante a lua cheia. No Brasil, a lenda fala de um filho
            amaldiçoado que vaga entre cemitérios em noites sombrias.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalLobisomem').showModal()"
                class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - LOBISOMEM -->
<dialog id="modalLobisomem"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-gray-800">Lenda do Lobisomem</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            A lenda do lobisomem é uma das histórias mais famosas do folclore mundial. Ela conta sobre a
            transformação de um homem em uma criatura meio humana, meio lobo, especialmente durante as
            noites de lua cheia — fenômeno conhecido como <strong>licantropia</strong>.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-gray-800">Origem da Lenda</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li><strong>Mitologia grega:</strong> O rei Lycaon foi transformado em lobo por Zeus.</li>
            <li><strong>Europa:</strong> Colonizadores portugueses trouxeram histórias de homens-lobo.</li>
            <li><strong>Simbolismo:</strong> Pode representar jovens guerreiros tornando-se ferozes.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-gray-800">Variações Populares no Brasil</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li><strong>Maldição:</strong> O sétimo ou oitavo filho homem se torna lobisomem ao completar 13 anos.</li>
            <li><strong>Transformação:</strong> Rola no chão até virar fera de pelos escuros, garras e presas.</li>
            <li><strong>Ciclo:</strong> Precisa visitar sete cemitérios antes do amanhecer.</li>
            <li><strong>Aparência:</strong> Homem branco vira lobo preto e vice-versa.</li>
            <li><strong>Comportamento:</strong> Não ataca sem ser provocado.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-gray-800">Como se Proteger</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Rezar três Ave-Marias ao se deparar com ele.</li>
            <li>Para quebrar a maldição, bater na cabeça do lobisomem sem que ele perceba.</li>
            <li>Cuidado: Se uma gota de sangue dele cair em alguém, essa pessoa também vira lobisomem.</li>
        </ul>
    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalLobisomem').close()"
            class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Fechar
        </button>
    </div>

</dialog>
<!-- CARD - NEGRINHO DO PASTOREIO -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-amber-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-700 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-horse text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Negrinho do Pastoreio</h3>
        <p class="text-sm text-amber-700 font-semibold text-center mb-6 uppercase tracking-wide">
            O Protetor dos Perdidos
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Espírito de um menino escravizado que, após um milagre, passou a ajudar pessoas a
            encontrar objetos perdidos, guiado pela luz da fé.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalNegrinho').showModal()"
                class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - NEGRINHO DO PASTOREIO -->
<dialog id="modalNegrinho"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-amber-700">Lenda do Negrinho do Pastoreio</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            A lenda do Negrinho do Pastoreio é um dos maiores símbolos espirituais e folclóricos do Rio
            Grande do Sul. Ela narra a história de um menino escravizado que, após sofrer uma punição
            brutal, foi salvo milagrosamente pela Virgem Maria. A partir desse momento, transforma-se em
            um protetor que ajuda aqueles que perderam algo importante.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-amber-700">A Lenda</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li><strong>Punição:</strong> Um fazendeiro violento acorrenta o menino escravo em um 
                formigueiro como castigo por perder um cavalo baio.</li>
            <li><strong>Milagre:</strong> No dia seguinte, o fazendeiro o encontra ileso, com a pele lisa,
                protegido pela Virgem Maria, e com o cavalo baio e os animais perdidos ao seu lado.</li>
            <li><strong>Perdão:</strong> O fazendeiro, arrependido, tenta pedir desculpas, mas o menino não
                responde.</li>
            <li><strong>Partida:</strong> O Negrinho monta no cavalo baio e desaparece pelos campos,
                tornando-se um espírito errante que ajuda quem precisa.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-amber-700">Como pedir ajuda ao Negrinho</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li>Acenda uma vela ao ar livre, como em um mourão ou sob uma árvore.</li>
            <li>Repita a frase: <em>"Foi por aí que eu perdi..."</em></li>
            <li>A luz da vela é vista como um pagamento à Virgem Maria pelo auxílio.</li>
        </ul>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalNegrinho').close()"
            class="px-6 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800">
            Fechar
        </button>
    </div>

</dialog>

<!-- CARD - SACI-PERERÊ -->
<div
    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">

    <div class="bg-red-600 h-3"></div>

    <div class="p-8">
        <div
            class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-full mb-6 mx-auto">
            <i class="fa-solid fa-hat-wizard text-3xl"></i>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">Saci-Pererê</h3>
        <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase tracking-wide">
            O Travesso das Matas
        </p>

        <!-- RESUMO -->
        <p class="text-gray-600 text-justify leading-relaxed mb-6">
            Travesso de uma perna só, famoso por pregar peças e trançar a crina dos cavalos.
            Uma figura brincalhona, mas também guardião das matas.
        </p>

        <!-- BOTÃO -->
        <div class="text-center">
            <button onclick="document.getElementById('modalSaci').showModal()"
                class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                Ler mais
            </button>
        </div>
    </div>
</div>

<!-- MODAL - SACI -->
<dialog id="modalSaci"
    class="rounded-xl p-6 w-full max-w-3xl backdrop:bg-black/50">

    <h2 class="text-3xl font-bold mb-4 text-red-700">Lenda do Saci-Pererê</h2>

    <div class="text-gray-700 leading-relaxed space-y-4 max-h-[70vh] overflow-y-auto pr-3">

        <p>
            Segundo o folclore brasileiro, o Saci-Pererê é o responsável por trançar a crina
            dos cavalos durante a noite, deixando nós quase impossíveis de desfazer. A figura
            do Saci é associada à travessura, malandragem e ao mistério das matas.
        </p>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Lendas e Folclore</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li><strong>Saci-Pererê:</strong> Popularmente responsável por fazer nós e tranças nas
                crinas dos cavalos, especialmente nas noites de lua nova.</li>
            <li><strong>Caipora:</strong> Em algumas regiões, a mesma travessura é atribuída à Caipora,
                protetora dos animais da mata.</li>
            <li><strong>Bruxas:</strong> Alguns relatos mencionam bruxas que deixariam crinas
                completamente emaranhadas.</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 text-red-700">Explicações Científicas</h3>
        <ul class="list-disc pl-6 space-y-2">
            <li><strong>Morcegos:</strong> Podem pousar na crina para se alimentar e, ao se moverem,
                acabam emaranhando os pelos.</li>
            <li><strong>Corujas:</strong> Ao pousarem na crina para observar o pasto, podem enrolar
                parte dos fios com as patinhas.</li>
        </ul>

    </div>

    <div class="text-center mt-6">
        <button onclick="document.getElementById('modalSaci').close()"
            class="px-6 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800">
            Fechar
        </button>
    </div>

</dialog>
    <br>
    <br> 
<!-- Footer Quote -->
            <div class="mt-16 text-center">
                <blockquote class="text-xl italic text-gray-500 font-serif">
                    "É a manifestação cultural do povo brasileiro, incluindo: 
                     Lendas e Mitos: Histórias fantásticas como as do Boto Cor-de-Rosa, Mula-sem-Cabeça e Lobisomem. 
                     Festas Populares: Como o Carnaval, que absorveu influências locais. 
                     Músicas e Danças: Ritmos regionais e cantigas. 
                     Artesanato e Culinária: Tradições locais passadas de pais para filhos."
                </blockquote>
            </div>

        </div>
    </div>
@endsection
