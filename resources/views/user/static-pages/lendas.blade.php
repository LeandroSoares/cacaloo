@extends('layouts.user')

@section('title', 'Lendas do Folclore')

@section('content')
<style>
    .folclore-hero {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #D4AF37 100%) !important;
        border-radius: 2rem !important;
        padding: 4rem 2rem !important;
        color: white !important;
        margin-bottom: 3rem !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
        position: relative;
        overflow: hidden;
    }

    .folclore-card {
        background: white !important;
        border-radius: 1.5rem !important;
        border: 1px solid #E5E7EB !important;
        padding: 2.5rem !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
        position: relative;
    }

    .folclore-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
    }

    .folclore-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 1.25rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 1.5rem !important;
        font-size: 1.75rem !important;
    }

    .btn-folclore {
        margin-top: auto !important;
        padding: 1rem 2rem !important;
        border-radius: 1.25rem !important;
        font-weight: 800 !important;
        text-align: center !important;
        transition: all 0.3s ease !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        font-size: 0.85rem !important;
        border: none !important;
        cursor: pointer !important;
        color: white !important;
    }

    .premium-modal-header {
        padding: 2.5rem !important;
        color: white !important;
        position: relative;
    }

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
    <div class="folclore-hero">
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight">Mitos e <span style="color: #F4D365">Lendas</span></h1>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl leading-relaxed">
                Explore o rico conjunto de histórias, seres encantados e mistérios que formam a alma cultural do Brasil. Uma jornada por tradições preservadas pela voz do povo.
            </p>
        </div>
    </div>

    <!-- Legends Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- CARD - COMADRE FULOZINHA -->
        <div class="folclore-card" style="border-top: 8px solid #059669">
            <div class="folclore-icon-box" style="background: #ECFDF5; color: #059669">
                <i class="fa-solid fa-leaf"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Comadre Fulozinha</h3>
            <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 block">Guardiã da Mata</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Entidade nordestina protetora das matas. Ajuda quem respeita a natureza e confunde aqueles que a agridem.</p>
            <button onclick="document.getElementById('modalFulozinha').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #059669">Conhecer Mistério</button>
        </div>

        <!-- CARD - IARA (MÃE D'ÁGUA) -->
        <div class="folclore-card" style="border-top: 8px solid #2563EB">
            <div class="folclore-icon-box" style="background: #EFF6FF; color: #2563EB">
                <i class="fa-solid fa-water"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Iara – Mãe D’Água</h3>
            <span class="text-xs font-black text-blue-700 uppercase tracking-widest mb-4 block">A Senhora dos Rios</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Linda sereia dos rios amazônicos com canto irresistível. Protetora sagrada da vida aquática e das águas doces.</p>
            <button onclick="document.getElementById('modalIara').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #2563EB">Conhecer Mistério</button>
        </div>

        <!-- CARD - MULA SEM CABEÇA -->
        <div class="folclore-card" style="border-top: 8px solid #EA580C">
            <div class="folclore-icon-box" style="background: #FFF7ED; color: #EA580C">
                <i class="fa-solid fa-horse"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Mula Sem Cabeça</h3>
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest mb-4 block">A Maldição Flamejante</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Criatura flamejante que galopa nas noites escuras. Representa a punição espiritual e o temor do desconhecido.</p>
            <button onclick="document.getElementById('modalMula').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #EA580C">Conhecer Mistério</button>
        </div>

        <!-- CARD - VITÓRIA-RÉGIA -->
        <div class="folclore-card" style="border-top: 8px solid #9333EA">
            <div class="folclore-icon-box" style="background: #FAF5FF; color: #9333EA">
                <i class="fa-solid fa-spa"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Vitória-Régia</h3>
            <span class="text-xs font-black text-purple-700 uppercase tracking-widest mb-4 block">A Estrela das Águas</span>
            <p class="text-gray-600 mb-6 leading-relaxed">A índia Naiá que se transformou em planta por amor à Lua. Simboliza o renascimento e a beleza da noite.</p>
            <button onclick="document.getElementById('modalVitoriaRegia').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #9333EA">Conhecer Mistério</button>
        </div>

        <!-- CARD - BOITATÁ -->
        <div class="folclore-card" style="border-top: 8px solid #DC2626">
            <div class="folclore-icon-box" style="background: #FEF2F2; color: #DC2626">
                <i class="fa-solid fa-fire"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Boitatá</h3>
            <span class="text-xs font-black text-red-700 uppercase tracking-widest mb-4 block">A Cobra de Fogo</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Serpente de fogo protetora das matas que assusta quem destrói a natureza. O brilho intenso da justiça divina.</p>
            <button onclick="document.getElementById('modalBoitata').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #DC2626">Conhecer Mistério</button>
        </div>

        <!-- CARD - BOTO COR-DE-ROSA -->
        <div class="folclore-card" style="border-top: 8px solid #DB2777">
            <div class="folclore-icon-box" style="background: #FDF2F8; color: #DB2777">
                <i class="fa-solid fa-hat-cowboy"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Boto Cor-de-Rosa</h3>
            <span class="text-xs font-black text-pink-700 uppercase tracking-widest mb-4 block">O Sedutor das Águas</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Criatura amazônica que se transforma em homem charmoso para encantar mulheres nas noites de luar.</p>
            <button onclick="document.getElementById('modalBoto').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #DB2777">Conhecer Mistério</button>
        </div>

        <!-- CARD - CABOCLO D'ÁGUA -->
        <div class="folclore-card" style="border-top: 8px solid #1E40AF">
            <div class="folclore-icon-box" style="background: #DBEAFE; color: #1E40AF">
                <i class="fa-solid fa-water"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Caboclo D’Água</h3>
            <span class="text-xs font-black text-blue-800 uppercase tracking-widest mb-4 block">Guardião dos Rios</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Espírito das águas do Rio São Francisco. Respeitado por pescadores como o guardião das profundezas.</p>
            <button onclick="document.getElementById('modalCabocloAgua').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #1E40AF">Conhecer Mistério</button>
        </div>

        <!-- CARD - CAIPORA -->
        <div class="folclore-card" style="border-top: 8px solid #059669">
            <div class="folclore-icon-box" style="background: #ECFDF5; color: #059669">
                <i class="fa-solid fa-paw"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Caipora</h3>
            <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 block">Protetora da Fauna</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Espírito protetor que montado em seu porco-do-mato, garante o equilíbrio e a proteção dos animais selvagens.</p>
            <button onclick="document.getElementById('modalCaipora').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #059669">Conhecer Mistério</button>
        </div>

        <!-- CARD - CUCA -->
        <div class="folclore-card" style="border-top: 8px solid #7E22CE">
            <div class="folclore-icon-box" style="background: #F5F3FF; color: #7E22CE">
                <i class="fa-solid fa-hat-wizard"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Cuca</h3>
            <span class="text-xs font-black text-purple-700 uppercase tracking-widest mb-4 block">Bruxa do Imaginário</span>
            <p class="text-gray-600 mb-6 leading-relaxed">A temível bruxa jacaré que habita as cavernas e povoa os contos de ninar com seu poder e vigília constante.</p>
            <button onclick="document.getElementById('modalCuca').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #7E22CE">Conhecer Mistério</button>
        </div>

        <!-- CARD - CURUPIRA -->
        <div class="folclore-card" style="border-top: 8px solid #059669">
            <div class="folclore-icon-box" style="background: #ECFDF5; color: #059669">
                <i class="fa-solid fa-shoe-prints"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Curupira</h3>
            <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 block">Mestre das Trilhas</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Menino de pés virados para trás que protege as florestas, confundindo caçadores e desbravadores mal-intencionados.</p>
            <button onclick="document.getElementById('modalCurupira').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #059669">Conhecer Mistério</button>
        </div>

        <!-- CARD - LOBISOMEM -->
        <div class="folclore-card" style="border-top: 8px solid #1F2937">
            <div class="folclore-icon-box" style="background: #F3F4F6; color: #1F2937">
                <i class="fa-solid fa-wolf-pack-battalion"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Lobisomem</h3>
            <span class="text-xs font-black text-gray-600 uppercase tracking-widest mb-4 block">Fera do Luar</span>
            <p class="text-gray-600 mb-6 leading-relaxed">O homem amaldiçoado que se transforma em fera. Uma lenda de mistério e temor nas noites de lua cheia.</p>
            <button onclick="document.getElementById('modalLobisomem').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #1F2937">Conhecer Mistério</button>
        </div>

        <!-- CARD - SACI-PERERÊ -->
        <div class="folclore-card" style="border-top: 8px solid #B91C1C">
            <div class="folclore-icon-box" style="background: #FEF2F2; color: #B91C1C">
                <i class="fa-solid fa-hat-wizard"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Saci-Pererê</h3>
            <span class="text-xs font-black text-red-700 uppercase tracking-widest mb-4 block">O Travesso Malandro</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Brincalhão de uma perna só que vive nos redemoinhos de vento, protegendo as matas com suas travessuras.</p>
            <button onclick="document.getElementById('modalSaci').showModal()" class="btn-folclore shadow-lg active:scale-95" style="background: #B91C1C">Conhecer Mistério</button>
        </div>

    </div>
</div>

<!-- MODAIS -->
<x-modal-premium id="modalFulozinha" title="Comadre Fulozinha" subtitle="Guardiã Ancestral da Mata" icon="fa-solid fa-leaf" headerGradient="linear-gradient(135deg, #059669 0%, #064e3b 100%)">
    <p>A lenda da Comadre Fulozinha é uma figura do folclore nordestino que protege a mata, descrita como uma entidade feminina com longos cabelos negros, que pode ser tanto brincalhona quanto vingativa.</p>
    <p>As histórias mais populares contam que ela era uma índia que se perdeu na floresta e morreu, passando a proteger a natureza após um encontro com as árvores.</p>
	<p>Ela prega peças em quem desrespeita a floresta, como lenhadores e caçadores, mas também ajuda aqueles que a respeitam, que por isso lhe deixam oferendas como fumo ou mel.</p>
    <p><strong>Origem:</strong> Existem diferentes versões sobre sua origem, mas uma das mais comuns é a de uma menina ou índia que se perdeu na mata e morreu. A lenda diz que ela vive na floresta para proteger as árvores e os animais.</p>
    <p><strong>Aparência:</strong> É descrita como uma jovem com longos cabelos negros, adornada com folhas e ramos.</p>
	<p><strong>Comportamento:</strong> Seu comportamento é ambíguo: ela pode ser amiga dos animais e pregar peças neles, mas também pode ser severa com humanos que desrespeitam a natureza. Para se proteger de sua fúria, as pessoas deixam oferendas de fumo, mel ou comida em troncos de árvores.</p>
	<p><strong>Poderes:</strong> Ela é conhecida por sua agilidade e inteligência, podendo confundir quem entra na mata sem licença.</p>
	<p><strong>Variações:</strong> Em algumas regiões, ela é conhecida como "Flor do Mato" ou "Mãe da Mata". A lenda também é cultuada em algumas religiões como a Jurema Sagrada.</p>
</x-modal-premium>

<x-modal-premium id="modalIara" title="Iara – Mãe D’Água" subtitle="A Senhora dos Rios" icon="fa-solid fa-water" headerGradient="linear-gradient(135deg, #2563EB 0%, #1e3a8a 100%)">
    <p>A lenda da Iara, também conhecida como Mãe-d'Água, conta a história de uma linda sereia do folclore brasileiro que vive nos rios, principalmente na Amazônia.</p>
    <p>Sua origem é a de uma índia guerreira que, após fugir de seus irmãos ciumentos, foi jogada em um rio pelo próprio pai, sendo salva pelos peixes e transformada em sereia pela lua cheia. Com seu canto e beleza hipnotizantes, ela atrai homens para o fundo d'água, onde eles desaparecem para sempre</p>
	<p><strong>A origem da lenda</strong></p>
    <p><strong>Origem indígena:</strong> A versão mais conhecida da lenda descreve Iara como uma índia guerreira, filha de um pajé, que era elogiada por sua coragem e beleza.</p>
	<p><strong>Fuga e transformação:</strong> Após matar seus irmãos para se defender, ela fugiu para a mata. Seu pai a encontrou e, como castigo, a jogou em um rio. Os peixes a salvaram, e na noite de lua cheia, ela foi transformada em uma sereia.</p>
	<p><strong>Origem europeia:</strong> Outras interpretações sugerem que a lenda tem elementos europeus, como a sereia da mitologia grega, que foram misturados com elementos indígenas durante a colonização portuguesa.</p>
	<p><strong>A lenda na prática</strong></p>
    <p><strong>Atração mortal:</strong> A Iara encanta os homens com sua beleza e seu canto irresistível, atraindo-os para o fundo dos rios.</p>
	<p><strong>Salva-vidas dos animais:</strong> Em algumas versões, a lenda é apresentada de forma mais branda, onde Iara é uma protetora dos rios e dos animais.</p>
	<p><strong>Protetora das águas:</strong> Ela também é conhecida como Mãe-d'Água e é vista como protetora dos rios e da vida aquática.</p>
	<p><strong>A aparência:</strong> A descrição da Iara varia. Algumas versões a retratam como uma sereia loira de olhos azuis, enquanto outras a descrevem com pele parda e olhos e cabelos escuros, como os das índias da Amazônia.</p>
	<p><strong>Como se proteger da Iara</strong></p>
	<p>Para se proteger do encanto da Iara, as lendas sugerem fechar os olhos e tapar os ouvidos para não ouvir seu canto.</p>
</x-modal-premium>

<x-modal-premium id="modalMula" title="Mula Sem Cabeça" subtitle="A Maldição Flamejante" icon="fa-solid fa-horse" headerGradient="linear-gradient(135deg, #EA580C 0%, #9a3412 100%)">
    <p>A lenda da Mula sem Cabeça é um mito do folclore brasileiro sobre uma mulher amaldiçoada que se transforma em uma mula flamejante sem cabeça.</p>
    <p>Essa punição ocorre, tradicionalmente, por um pecado grave, como um relacionamento com um padre.</p>
    <p>Ela galopa de forma descontrolada, marcando o fim da transformação somente quando o galo canta pela terceira vez.</p>
	<p>A criatura assusta as pessoas com seu relincho alto, aparência de fogo no lugar da cabeça e cascos que fazem barulho, geralmente correndo pela mata nas noites de quinta para sexta-feira.</p>
	<p><strong>Origem:</strong> A lenda é frequentemente vista como um conto moral para reforçar os valores da época. A maldição é uma punição para mulheres que se relacionavam com padres.</p>
    <p><strong>Aparência:</strong> É uma mula de cor preta ou marrom que não tem cabeça, mas sim uma tocha de fogo em seu lugar. Seus cascos costumam ter ferraduras de aço ou prata.</p>
	<p><strong>Comportamento:</strong> A mula galopa furiosamente, solta relinchos assustadores que se ouvem a quilômetros e às vezes emite gemidos humanos.</p>
	<p><strong>Maldição e cura:</strong> A maldição ocorre principalmente nas noites de quinta para sexta-feira e a mulher só volta a sua forma humana quando o galo canta pela terceira vez.</p>
</x-modal-premium>

<x-modal-premium id="modalVitoriaRegia" title="Vitória-Régia" subtitle="A Estrela das Águas" icon="fa-solid fa-spa" headerGradient="linear-gradient(135deg, #9333EA 0%, #581c87 100%)">
    <p>A lenda da vitória-régia conta a história da índia Naiá, que se apaixonou por Jaci (a Lua) e desejou se transformar em estrela para viver ao lado dele no céu.</p>
    <p>Uma noite, ao ver o reflexo da Lua na água, ela se jogou no lago, mas, em vez de alcançar a Lua, afogou-se. Comovido, Jaci a transformou na vitória-régia, a "estrela das águas", cuja flor desabrocha à noite.</p>
    <p><strong>A índia Naiá:</strong> Era uma jovem índia que se apaixonou pela Lua, um deus na mitologia indígena.</p>
    <p><strong>O desejo:</strong> Ela ansiava por ser transformada em estrela para poder morar com Jaci no céu.</p>
	<p><strong>A tragédia:</strong> Em uma noite de verão, ao ver o reflexo da Lua na água, ela acreditou que o deus estava ali e mergulhou no lago. Ela não conseguiu mais sair e se afogou.</p>
	<p><strong>A transformação:</strong> Comovido com o sacrifício de Naiá, Jaci a transformou na vitória-régia, uma planta aquática.</p>
	<p><strong>O significado:</strong> A flor da vitória-régia é conhecida como a "estrela das águas". Ela abre à noite e desabrocha ao amanhecer, como uma homenagem a Naiá.</p>
</x-modal-premium>

<x-modal-premium id="modalBoitata" title="Boitatá" subtitle="A Cobra de Fogo" icon="fa-solid fa-fire" headerGradient="linear-gradient(135deg, #DC2626 0%, #7f1d1d 100%)">
    <p>Boitatá é uma lenda do folclore brasileiro, originária do tupi-guarani (que significa "cobra de fogo"), de uma grande serpente de fogo que protege as florestas e os animais.</p>
    <p>A criatura, com olhos luminosos e corpo flamejante, assusta invasores como caçadores e lenhadores que ameaçam a natureza.</p>
	<p>Em algumas versões, pode se transformar em uma chama errante para confundir os destruidores de matas.</p>
	<p><strong>Origem:</strong> A lenda tem origem indígena e o nome deriva de "boi" (cobra) e "tatá" (fogo).</p>
    <p><strong>Função:</strong> É vista como a guardiã das matas e do meio ambiente, protegendo-os contra os incêndios provocados por ações humanas.</p>
	<p><strong>Características:</strong> É descrita como uma serpente gigantesca com olhos que brilham intensamente e um corpo coberto de fogo.</p>
	<p><strong>Capacidades:</strong> Além de ser uma cobra de fogo, pode se transformar em uma chama para se mover rapidamente pelos campos, enganando e afugentando intrusos.</p>
	<p><strong>Variações:</strong> Algumas lendas, como a de Padre Anchieta, se referem ao "baetatá" como uma entidade assustadora que pode matar sem motivo aparente, sendo a lenda do fogo-fátuo, que pode estar ligada à decomposição de matéria orgânica, uma possível explicação para a origem do mito.</p>
</x-modal-premium>

<x-modal-premium id="modalBoto" title="Boto Cor-de-Rosa" subtitle="O Sedutor das Águas" icon="fa-solid fa-hat-cowboy" headerGradient="linear-gradient(135deg, #DB2777 0%, #831843 100%)">
    <p>A lenda do boto cor-de-rosa é uma história do folclore brasileiro, principalmente da região amazônica, sobre um boto que se transforma em um homem charmoso e sedutor em noites de lua cheia.</p>
    <p>Ele sai do rio para dançar em festas, conquista mulheres para engravidá-las, mas foge ao amanhecer, retornando ao rio e desaparecendo para sempre.</p>
	<p><strong>Transformação:</strong> O boto se transforma em um homem bonito, elegante e sedutor, que frequentemente usa um chapéu para esconder a narina em sua cabeça, um detalhe que revela sua verdadeira natureza.</p>
    <p><strong>Objetivo:</strong> A principal intenção do boto na forma humana é seduzir as mulheres para engravidá-las.</p>
	<p><strong>O mistério do pai:</strong> As crianças nascidas dessas uniões acabam sendo filhas de um pai desconhecido, e a lenda é usada para justificar essas gravidezes, especialmente quando a mãe não pode ou não quer revelar a identidade do pai.</p>
	<p><strong>O retorno ao rio:</strong> Ao amanhecer, o homem-boto volta para o rio, retorna à sua forma de animal e desaparece, deixando a mulher grávida.</p>
	<p><strong>Consequências:</strong> Em algumas versões, o boto pode ser agressivo com os homens que tentam se aproximar de suas parceiras, ou ainda mais misterioso, pode ser protetor dos pescadores em certas histórias.</p>
</x-modal-premium>

<x-modal-premium id="modalCabocloAgua" title="Caboclo D’Água" subtitle="Guardião Sombrio dos Rios" icon="fa-solid fa-water" headerGradient="linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%)">
    <p>A lenda do Caboclo d'Água é um conto do folclore brasileiro, especialmente popular nas margens do Rio São Francisco, sobre um espírito protetor e malévolo das águas.</p>
    <p>Ele é descrito como um ser com pele dura, que pode virar barcos, afogar banhistas e afugentar peixes.</p>
	<p>Como forma de se proteger, pescadores e navegantes usam estrelas pintadas no casco das embarcações ou carrancas para afastar o Caboclo d'Água e outros maus espíritos.</p>
	<p><strong>Características do Caboclo d'Água</strong></p>
    <p><strong>Aparência:</strong> Possui pele dura e impenetrável, podendo ser descrito como musculoso e com escamas misturadas à pele.</p>
	<p><strong>Habitat:</strong> Vive nas profundezas dos rios, protegendo o leito, mas também pode se afastar para as margens.</p>
	<p><strong>Poderes:</strong></p>
	<p>Virar barcos e canoas.</p>
	<p>Afogar pessoas.</p>
	<p>Afugentar peixes.</p>
	<p>Assustar pescadores e navegantes com seus ruídos.</p>
	<p><strong>Proteção:</strong></p>
	<p>Pintar estrelas no casco dos barcos.</p>
	<p>Usar carrancas na proa das embarcações.</p>
	<p>Oferecer fumo para acalmá-lo.</p>
    <p><strong>Outras histórias:</strong></p>
	<p>Algumas versões do mito dizem que ele guarda uma gruta cheia de ouro.</p>
	<p>Em algumas cidades, ele se tornou um símbolo de medo para quem vive à beira d'água.</p>
	<p><strong>Variações da lenda</strong> Em algumas versões, a lenda é apresentada de forma mais branda, onde Iara é uma protetora dos rios e dos animais.</p>
	<p>A lenda do Caboclo d'Água varia de acordo com a região.</p>
	<p>Ele é também conhecido por outros nomes, como Bicho-d'água, Negro-d'água, ou Moleque-d'água</p>
</x-modal-premium>

<x-modal-premium id="modalCaipora" title="Caipora" subtitle="Guardiã Protetora das Matas" icon="fa-solid fa-paw" headerGradient="linear-gradient(135deg, #059669 0%, #064e3b 100%)">
    <p>Caipora é uma figura do folclore brasileiro, um espírito protetor das matas e animais, frequentemente descrito como um ser que protege a floresta de caçadores excessivos.</p>
    <p>A origem do nome vem do tupi-guarani "caapora", que significa "morador do mato".</p>
	<p>Sua aparência varia conforme a região, podendo ser uma índia de cabelos vermelhos, um anão peludo ou outra forma de guardião, e é conhecida por pregar peças ou amedrontar.</p>
	<p><strong>Origem e Significado:</strong> A palavra vem do tupi-guarani "caapora" ("habitante do mato") e a lenda tem raízes antigas no Brasil, sendo considerada por alguns folcloristas como uma variação do Curupira.</p>
    <p><strong>Função:</strong> Proteger a floresta e seus animais, agindo contra caçadores que matam mais do que o necessário. Em algumas versões, é também um guardião da vida selvagem em geral.</p>
	<p><strong>Aparência:</strong> As descrições variam bastante:</p>
	<p>Uma jovem índia com cabelos avermelhados e orelhas pontudas.</p>
	<p>Um anão peludo com pelos verdes.</p>
	<p>Um ser masculino, atarracado e peludo, que monta um queixada (porco-do-mato).</p>
	<p><strong>Poderes e Comportamento:</strong> Pode se manifestar para confundir ou aterrorizar caçadores. Em algumas lendas, pode se mostrar violenta, mas também aceita oferendas como fumo e álcool, especialmente se o caçador demonstrar respeito pela natureza.</p>
	<p><strong>Sinônimos e Variações:</strong> Dependendo da região, pode ser conhecida por outros nomes como Curupira, Pai-do-Mato, Dona-das-Folhas, e há versões femininas como Comadre Fulosinha, especialmente no Nordeste. A expressão "encaiporado" é usada para se referir a alguém que está tendo um período de azar ou infelicidade.</p>
</x-modal-premium>

<x-modal-premium id="modalCuca" title="Cuca" subtitle="Bruxa Temível do Folclore" icon="fa-solid fa-hat-wizard" headerGradient="linear-gradient(135deg, #7E22CE 0%, #4c1d95 100%)">
    <p>A lenda da Cuca é uma figura do folclore brasileiro, popularizada por Monteiro Lobato, que representa uma bruxa assustadora com cabeça de jacaré.</p>
    <p>Ela é conhecida por roubar crianças desobedientes que não querem dormir.</p>
	<p>A lenda era usada antigamente para amedrontar as crianças, dizendo que a Cuca as pegaria se não obedecessem aos pais ou não fossem para a cama na hora.</p>
	<p><strong>Origem e características da Cuca</strong></p>
	<p><strong>Origem:</strong> A lenda tem origens ibéricas, com a figura do "Coco" ou "Coca", que aterrorizava crianças em Portugal e Espanha.</p>
    <p><strong>Aparência:</strong> Inicialmente, a descrição da Cuca era a de uma velha bruxa corcunda, com pele rugosa e cabelos brancos. A versão mais famosa, popularizada por Monteiro Lobato, a retrata como uma bruxa velha com a face de um jacaré, unhas longas e cabelos loiros.</p>
	<p><strong>Poderes:</strong> A Cuca é descrita como sendo muito poderosa e má, capaz de se transformar em outros animais, como a coruja e a borboleta, para se aproximar das crianças.</p>
	<p><strong>Sono:</strong> A lenda afirma que a Cuca dorme apenas uma vez a cada sete anos, por isso, está sempre acordada e pronta para pegar as crianças que não obedecem.</p>
	<p><strong>Caverna:</strong> Acredita-se que ela viva em uma caverna, onde prepara suas poções mágicas e feitiços durante a noite.</p>
</x-modal-premium>

<x-modal-premium id="modalCurupira" title="Curupira" subtitle="Guardião das Florestas" icon="fa-solid fa-shoe-prints" headerGradient="linear-gradient(135deg, #059669 0%, #064e3b 100%)">
    <p>Curupira é uma figura mítica do folclore brasileiro, conhecido como o protetor das florestas e dos animais.</p>
    <p>Ele é retratado como um menino ou anão de cabelos vermelhos e dentes afiados, sendo sua característica mais marcante os pés virados para trás.</p>
	<p>Essa particularidade serve para confundir caçadores, pois suas pegadas indicam uma direção contrária à que ele realmente segue.</p>
	<p><strong>Função:</strong> Ele pune caçadores e desmatadores que agridem a natureza, sendo considerado o guardião da floresta e um protetor dos animais.</p>
    <p><strong>Habilidades:</strong> O Curupira usa truques e ilusões para afastar intrusos, como imitar sons de animais, criar caminhos falsos e produzir assobios agudos para desorientar e assustar as pessoas.</p>
	<p><strong>Origem:</strong> A lenda tem origem indígena e o nome é interpretado do tupi como "corpo de menino" ou "coberto de pústulas", dependendo da fonte. A primeira menção escrita da lenda data de 1560, por conta de uma carta do padre José de Anchieta.</p>
	<p><strong>Características:</strong> Além dos pés virados para trás, Curupira é descrito com cabelos ruivos ou em chamas e dentes afiados. Ele pode ser seduzido ou despistado por oferendas, como iguarias, ou distrações.</p>
</x-modal-premium>

<x-modal-premium id="modalLobisomem" title="Lobisomem" subtitle="A Maldição da Lua Cheia" icon="fa-solid fa-wolf-pack-battalion" headerGradient="linear-gradient(135deg, #1F2937 0%, #111827 100%)">
    <p>A lenda do lobisomem é uma história folclórica mundialmente conhecida sobre um homem que se transforma em um ser parte homem e parte lobo durante as noites de lua cheia, um fenômeno chamado licantropia.</p>
    <p>As lendas têm variações regionais, mas uma versão popular no Brasil conta que o homem amaldiçoado é o sétimo ou oitavo filho homem de uma família.</p>
	<p><strong>Origem da lenda</strong></p>
    <p><strong>Mitologia grega:</strong> O termo "licantropia" tem origem na mitologia grega, com a lenda do rei Lycaon, que foi transformado em lobo por Zeus como punição.</p>
	<p><strong>Transmissão europeia:</strong> A lenda foi trazida para o Brasil pelos colonizadores portugueses, com origens que remontam a histórias europeias.</p>
	<p><strong>Metáfora:</strong> Alguns estudiosos sugerem que a lenda pode ter sido uma metáfora para os jovens que se tornavam guerreiros ferozes em sociedades antigas.</p>
	<p><strong>Variações populares no Brasil</strong></p>
    <p><strong>Maldição do sétimo ou oitavo filho:</strong> A lenda conta que se uma família tem sete filhas mulheres, o oitavo filho homem amaldiçoado se transforma em lobisomem após completar 13 anos.</p>
	<p><strong>Transformação:</strong> O homem se esfrega no chão para se transformar em um lobo grande e peludo, com garras e presas.</p>
	<p><strong>Ciclo:</strong> Ele precisa visitar sete cemitérios antes do amanhecer para poder voltar à forma humana.</p>
	<p><strong>Aparência:</strong> Alguns dizem que o homem branco se transforma em lobo preto, e vice-versa.</p>
	<p><strong>Comportamento:</strong> O lobisomem só ataca quando é ameaçado.</p>
	<p><strong>Como se proteger</strong></p>
    <p><strong>Oração:</strong> Reza-se três Ave-Marias para se proteger se alguém se deparar com um lobisomem no caminho.</p>
	<p><strong>Ataque:</strong> Para quebrar a maldição, é preciso bater forte na cabeça do lobisomem sem ser percebido.</p>
	<p><strong>Atenção:</strong> Se uma gota de sangue do lobisomem cair na pessoa, ela também se transforma em lobisomem.</p>
</x-modal-premium>

<x-modal-premium id="modalSaci" title="Saci-Pererê" subtitle="O Travesso das Matas" icon="fa-solid fa-hat-wizard" headerGradient="linear-gradient(135deg, #B91C1C 0%, #7f1d1d 100%)">
    <p>Segundo o folclore brasileiro, o Saci-Pererê é o responsável por trançar a crina dos cavalos. No entanto, uma explicação mais científica aponta que animais como morcegos e corujas podem, acidentalmente, emaranhar a crina ao pousarem nela, o que acaba formando os nós e tranças.</p>
    <p><strong>Lendas e folclore</strong></p>
    <p><strong>Saci-Pererê:</strong> Na cultura popular, é atribuída a travessura do Saci fazer tranças e nós na crina dos cavalos, geralmente nas noites de lua nova.</p>
	<p><strong>Caipora:</strong> Outra lenda que envolve as tranças na crina dos cavalos é a da Caipora.</p>
	<p><strong>Bruxas:</strong> Em algumas histórias, até mesmo bruxas são mencionadas como sendo responsáveis pelas tranças, especialmente quando elas aparecem emaranhadas de forma quase impossível de desfazer.</p>
	<p><strong>Explicações científicas</strong></p>
    <p><strong>Morcegos:</strong> Morcegos, especialmente os hematófagos, podem pousar na crina do cavalo para se alimentar do sangue. Ao fazer isso, podem emaranhar os pelos.</p>
	<p><strong>Corujas:</strong> Corujas também podem pousar na crina do cavalo para observar o pasto. Ao fazer isso, suas patinhas podem acabar emaranhando os pelos.</p>
</x-modal-premium>
@endsection
