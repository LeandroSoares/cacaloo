@extends('layouts.user')

@section('content')
    <div class="py-12">
<div class="py-12 max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-8">Orientações da Casa</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Card 1 – Mandamentos da Casa -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Mandamentos da Casa </h2>
            <p class="text-gray-600 mb-4">
                Conjunto de responsabilidades e princípios que orientam o médium dentro da casa espiritual,
                enfatizando respeito, comprometimento, humildade e conduta exemplar.
            </p>
            <button onclick="document.getElementById('modal1').showModal()" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ler Mais
            </button>
        </div>

    </div>
</div>

<!-- MODAIS (Conteúdo Completo) -->

<!-- Modal 1 -->
<dialog id="modal1" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Mandamentos da Casa </h2>
        <p class="text-gray-700 leading-relaxed">
<p class="text-gray-700 leading-relaxed space-y-4">

    <strong class="text-lg">Mandamentos dos Médiuns e da Casa de Caridade</strong><br><br>

    <strong>1. Honrar a Umbanda, os Orixás e Guias Espirituais</strong><br>
    Respeitar a tradição, os rituais, os símbolos e os ensinamentos da Umbanda é fundamental. 
    O médium deve manter a fé, a devoção e a conexão espiritual, reconhecendo a força dos Orixás 
    e entidades que conduzem os trabalhos.<br><br>

    <strong>2. Amar e Servir com Caridade</strong><br>
    O médium deve praticar a caridade verdadeira, sem esperar recompensas materiais ou 
    reconhecimento. Cada gesto, palavra ou ação deve refletir amor e solidariedade. Servir é 
    doar-se com humildade, oferecendo auxílio aos necessitados, enfermos, aflitos e a todos que 
    buscam orientação espiritual.<br><br>

    <strong>3. Respeitar a Hierarquia Espiritual</strong><br>
    O médium deve honrar seus guias espirituais, mentores e dirigentes da Casa de Caridade, 
    reconhecendo sua experiência e sabedoria. Seguir suas orientações é essencial para evitar 
    erros e garantir a segurança nos trabalhos mediúnicos.<br><br>

    <strong>4. Cultivar a Pureza de Intenção</strong><br>
    Todas as ações do médium devem ser realizadas com sinceridade, honestidade e fé. Nenhum 
    trabalho deve ser feito por vaidade, ego ou interesse pessoal. A mediunidade é instrumento 
    de auxílio, não de poder.<br><br>

    <strong>5. Preservar o Sigilo e o Respeito</strong><br>
    O médium deve manter confidencialidade absoluta sobre tudo que ouve, vê ou recebe nos 
    atendimentos espirituais. Respeitar a privacidade do assistido é obrigação ética e espiritual.<br><br>

    <strong>6. Estudar e Buscar Evolução</strong><br>
    O médium deve dedicar-se ao aprendizado constante dos rituais e fundamentos da Umbanda, 
    assim como ao próprio crescimento moral e espiritual. A mediunidade exige responsabilidade, 
    conhecimento e disciplina.<br><br>

    <strong>7. Zelar pelo Espaço Sagrado</strong><br>
    A Casa de Caridade é um templo de luz. O médium deve contribuir para a harmonia, limpeza 
    física e energética, respeitando rituais, instrumentos e símbolos. Cada ambiente deve ser 
    tratado com reverência.<br><br>

    <strong>8. Praticar a Paciência e a Compaixão</strong><br>
    O médium deve atender assistidos com escuta ativa, paciência e empatia. Cada pessoa chega 
    com dores e necessidades diferentes, cabendo ao médium transmitir conforto, esperança e 
    equilíbrio.<br><br>

    <strong>9. Servir com Consistência</strong><br>
    A dedicação do médium não se limita às giras ou rituais. Deve refletir-se na vida diária, 
    demonstrando compromisso constante com a evolução própria e ajuda ao próximo.<br><br>

    <strong>10. Evitar Abusos e Atos Negativos</strong><br>
    O médium jamais deve usar a mediunidade para benefício próprio, manipulação ou vingança. 
    O poder mediúnico é para o bem, sempre guiado pela ética, moral, amor e caridade.<br><br>

    <strong>11. Cultivar a Humildade</strong><br>
    O médium deve reconhecer suas limitações, entendendo que a mediunidade é instrumento de 
    auxílio, não de superioridade. A humildade fortalece a conexão com os guias e evita o orgulho 
    espiritual.<br><br>

    <strong>12. Trabalhar pela Harmonia e Unidade</strong><br>
    O médium deve atuar pelo bem coletivo, evitando conflitos e divisões. A harmonia entre 
    médiuns e assistidos é essencial para que a energia flua de forma positiva.<br><br>

</p>

        </p>
        <button onclick="document.getElementById('modal1').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>
    </div>
</dialog>

@endsection
