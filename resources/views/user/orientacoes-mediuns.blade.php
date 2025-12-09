@extends('layouts.user')

@section('content')
    <div class="py-12">
<div class="py-12 max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-8">Orientações da Casa</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Card 1 – Conduta do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Conduta do Médium</h2>
            <p class="text-gray-600 mb-4">
                Diretrizes para que o médium mantenha equilíbrio emocional, disciplina espiritual,
                respeito às entidades e postura adequada dentro e fora do templo.
            </p>
            <button onclick="document.getElementById('modal2').showModal()" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Ler Mais
            </button>
        </div>

        <!-- Card 2 – Disciplina do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Disciplina do Médium</h2>
            <p class="text-gray-600 mb-4">
                Conteúdo que explica as obrigações espirituais, horários, respeito às hierarquias
                e importância da disciplina para o desenvolvimento mediúnico.
            </p>
            <button onclick="document.getElementById('modal3').showModal()" 
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Ler Mais
            </button>
        </div>

        <!-- Card 3 – Preparação do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Preparação do Médium antes dos Trabalhos</h2>
            <p class="text-gray-600 mb-4">
                Recomendações sobre banho de descarrego, alimentação, limpeza energética,
                mentalização e cuidados essenciais antes dos trabalhos espirituais.
            </p>
            <button onclick="document.getElementById('modal4').showModal()" 
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Ler Mais
            </button>
        </div>

    </div>
</div>

<!-- MODAIS (Conteúdo Completo) -->

<!-- Modal 1 -->
<dialog id="modal2" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Conduta do Médium</h2>
        <p class="text-gray-700 leading-relaxed">
<p class="text-gray-700 leading-relaxed space-y-4">

    <strong class="text-lg">Conduta do Médium</strong><br><br>

    A conduta e o cuidado dos médiuns da Casa de Caridade envolvem ética, disciplina, respeito 
    e preparo contínuo, tanto dentro quanto fora do terreiro. A mediunidade é um compromisso 
    sagrado e uma ferramenta para a caridade.<br><br>

    <strong class="text-lg">Condutas no Terreiro</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Realizar as firmezas espirituais:</strong> Trabalhar com a proteção do Anjo da Guarda (direita)
        e Trindade da Esquerda, fortalecendo a defesa energética antes dos trabalhos.</li>

        <li><strong>Respeito e silêncio:</strong> Manter postura de profundo respeito ao local sagrado, aos guias espirituais,
        dirigentes e outros médiuns. Evitar conversas paralelas, fofocas, brincadeiras ou agitação.</li>

        <li><strong>Assiduidade e pontualidade:</strong> Cumprir a frequência às giras e chegar no horário estabelecido 
        para o preparo inicial.</li>

        <li><strong>Vestimenta adequada:</strong> Usar roupas apropriadas, geralmente brancas e limpas, conforme regras
        do terreiro.</li>

        <li><strong>Disciplina na corrente:</strong> Seguir orientações do dirigente e guias, mantendo harmonia
        e concentração da corrente mediúnica.</li>

        <li><strong>Postura durante a incorporação:</strong> Tratar o trabalho com seriedade, permitindo manifestação 
        digna das entidades, sem exageros ou exibição.</li>

        <li><strong>Dormir adequadamente:</strong> Garantir descanso suficiente para corpo e mente estarem equilibrados.</li>

        <li><strong>Alimentação equilibrada:</strong> Optar por refeições leves e evitar carnes vermelhas, gorduras
        e alimentos pesados.</li>

        <li><strong>Evitar álcool e substâncias:</strong> Substâncias alteradoras podem prejudicar a sintonia espiritual.</li>

        <li><strong>Abstenção sexual nas últimas 24 horas:</strong> Preserva a energia vital do médium.</li>

        <li><strong>Evitar excessos:</strong> Moderar atividades físicas ou situações desgastantes energeticamente.</li>

        <li><strong>Práticas espirituais de preparo:</strong> Realizar preces, banhos de limpeza, meditação ou momentos
        de silêncio antes da gira.</li>
    </ul><br>

    <strong class="text-lg">Cuidados e Preparo Pessoal</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Equilíbrio emocional:</strong> Manter a mente calma e evitar situações estressantes antes dos trabalhos.</li>

        <li><strong>Estudo contínuo:</strong> A Umbanda exige estudo constante: fundamentos, Orixás, entidades, rituais
        e autoconhecimento.</li>

        <li><strong>Cuidado com as guias:</strong> Tratar colares e acessórios rituais com respeito, guardando-os 
        adequadamente e evitando que outras pessoas os manuseiem.</li>

        <li><strong>Oração e elevação espiritual:</strong> Manter rotina de prece e conexão com o anjo de guarda e guias,
        fortalecendo proteção e sintonia.</li>
    </ul><br>

    Essas práticas garantem que o médium esteja física, mental e espiritualmente preparado, preservando proteção,
    concentração e eficácia dos trabalhos espirituais, além de manter a harmonia energética da casa.<br><br>

    <strong class="text-lg">Conduta Fora do Terreiro</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Moralidade e ética:</strong> Manter conduta reta e justa em todos os momentos, refletindo os princípios 
        da Umbanda: caridade, fraternidade e moralidade.</li>

        <li><strong>Discrição:</strong> Nunca usar a mediunidade para autopromoção, vantagens pessoais ou previsões 
        irresponsáveis. A mediunidade é para servir, não para alimentar o ego.</li>
    </ul><br>

    Em resumo, a responsabilidade do médium vai além do momento da incorporação, sendo um compromisso de vida
    com a espiritualidade e com a prática da caridade.

</p>

        </p>
        <button onclick="document.getElementById('modal2').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>
        </dialog>
<!-- Modal 2 -->
<dialog id="modal3" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Disciplina do Médium</h2>
        <p class="text-gray-700 leading-relaxed">
<p class="text-gray-700 leading-relaxed space-y-4">

    <strong class="text-lg">Disciplina do Médium de Umbanda</strong><br><br>

    <ul class="list-disc pl-6 space-y-3">

        <li><strong>Horário:</strong> Todos os médiuns devem chegar às giras de desenvolvimento com pelo menos 
        10 minutos de antecedência do horário oficial de início.</li>

        <li><strong>Saudação ao chegar:</strong> Ao entrar na Casa de Caridade, o médium deve saudar a 
        casa dos Pretos-Velhos e a casa dos Compadres, pedindo:
            <ul class="list-disc pl-6 mt-2 space-y-1">
                <li>permissão para entrar no terreiro;</li>
                <li>proteção durante os trabalhos;</li>
                <li>que energias negativas sejam dissipadas.</li>
            </ul>
        Após isso, deve dirigir-se diretamente ao vestiário, evitando conversas, distrações ou assuntos pessoais.</li>

        <li><strong>Silêncio no vestiário:</strong> O ambiente deve ser de recolhimento e oração. Conversas, 
        discussões ou comentários não são permitidos, salvo se autorizados pela Casa.</li>

        <li><strong>Respeito ao Congá:</strong> Ao se encaminhar ao Congá, manter postura respeitosa e seguir 
        o ritual estabelecido pela Coordenação.</li>

        <li><strong>Proibição de álcool:</strong> Nos dias de gira, é proibido o uso de bebidas alcoólicas. A energia 
        do médium sob efeito de álcool é negativa e interfere no campo espiritual.</li>

        <li><strong>Higiene pessoal e espiritual:</strong> O médium deve comparecer limpo, física, mental e 
        energeticamente. Isso inclui vestimentas brancas e ritualísticas limpas.</li>

        <li><strong>Conduta das médiuns:</strong> Maquiagens, esmaltes e adornos devem ser evitados. 
        Se houver maquiagem, deve ser removida antes dos trabalhos.</li>

        <li><strong>Ciclo menstrual:</strong> Médiums femininas podem participar das giras normalmente durante o período menstrual.</li>

        <li><strong>Respeito às hierarquias:</strong> Caso o médium fique descontente com algo, deve procurar o dirigente, 
        conversando diretamente e com humildade.</li>

        <li><strong>Faltas não justificadas:</strong> A ausência consecutiva sem justificativa (conforme estatuto) pode resultar 
        em afastamento da corrente mediúnica.</li>

        <li><strong>Comportamentos negativos:</strong> O médium que causar intrigas, escândalos ou promover desunião 
        entre irmãos será desligado da corrente e do quadro social.</li>

        <li><strong>Vestimenta ritualística:</strong> A roupa ritual possui modelo definido pela Casa e deve ser usada sempre limpa, 
        passada e sem desleixo.</li>

        <li><strong>Agenda de passes:</strong> Na entrada da Casa, haverá uma agenda com os nomes dos que tomarão passe. 
        O médium deve cumprir seu compromisso.</li>

        <li><strong>Ausências comunicadas:</strong> Caso o médium não possa comparecer, deve avisar a Mãe Sandra, 
        para que seu nome seja retirado da agenda e evitar transtornos com consulentes.</li>

    </ul>

</p>
        </p>
        <button onclick="document.getElementById('modal3').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>
</dialog>
<!-- Modal 3 -->
<dialog id="modal4" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Disciplina do Médium</h2>
        <p class="text-gray-700 leading-relaxed">
<p class="text-gray-700 leading-relaxed space-y-4">

    <strong class="text-lg">Preparação do Médium antes dos Trabalhos Mediúnicos</strong><br><br>

    A preparação do médium antes de ir para o terreiro é fundamental para garantir harmonia energética,
    concentração e receptividade espiritual. Os cuidados começam, geralmente, 12 horas antes da gira e envolvem
    práticas físicas, comportamentais e espirituais.<br><br>

    <strong class="text-lg">Preparação Física e Comportamental</strong><br><br>

    <strong>Preceitos (Abstinências):</strong><br>
    Os preceitos mais comuns na Casa de Caridade incluem a abstinência de:

    <ul class="list-disc pl-6 space-y-2 mt-2">
        <li><strong>Carne vermelha:</strong> Possui energia mais densa e interfere na vibração sutil necessária ao contato espiritual.</li>
        <li><strong>Bebidas alcoólicas:</strong> Prejudicam a clareza mental e a concentração.</li>
        <li><strong>Atividade sexual:</strong> A energia sexual deve ser preservada antes da gira, pois influencia diretamente a incorporação.</li>
        <li><strong>Locais de baixa vibração:</strong> Evitar ambientes promíscuos ou energeticamente densos no dia da gira.</li>
    </ul>

    <ul class="list-disc pl-6 space-y-2 mt-4">
        <li><strong>Alimentação leve:</strong> Optar por refeições leves e de fácil digestão.</li>
        <li><strong>Higiene pessoal:</strong> Estar limpo é sinal de respeito com a casa e com os guias espirituais.</li>
        <li><strong>Vestuário:</strong> Usar roupas limpas e claras (preferencialmente brancas) ou vestimentas ritualísticas da casa.</li>
    </ul><br>

    <strong class="text-lg">Preparação Mental e Espiritual</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Introspecção e serenidade:</strong> Manter a mente calma, evitando discussões, fofocas ou situações estressantes.</li>
        <li><strong>Oração e meditação:</strong> Dedicar tempo para orar e meditar, mantendo o pensamento alinhado aos propósitos da gira.</li>
    </ul><br>

    <strong class="text-lg">Firmezas das Forças Espirituais</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Firmeza do Anjo de Guarda:</strong> 1 vela branca.</li>

        <li><strong>Firmeza da Direita:</strong><br>
            Formar um triângulo com 3 velas da cor dos seus Orixás (ou brancas, se não souber quais são).
        </li>

        <li><strong>Firmeza da Esquerda:</strong><br>
            Triângulo com 3 velas preta/vermelha para Guardião, Guia Chefe e Pombagira.
        </li>
    </ul><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Banhos de ervas:</strong> Banhos de limpeza e harmonização (arruda, alecrim, guiné etc.) ajudam a purificar o campo áurico.</li>

        <li><strong>Banho de Amaci:</strong> Preparado com ervas específicas, aplicado na cabeça. Indicado para médiuns em desenvolvimento ou já prontos.</li>

        <li><strong>Conexão com os guias:</strong> Desde casa, o médium deve sintonizar-se com seus guias e Orixás, firmando a intenção de servir.</li>
    </ul><br>

    <strong class="text-lg">Ao Chegar no Terreiro</strong><br><br>

    <ul class="list-disc pl-6 space-y-2">
        <li><strong>Pontualidade:</strong> Chegar cedo demonstra respeito e permite o ajuste energético antes do início.</li>

        <li><strong>Saudação à casa:</strong> Cumprimentar tronqueira, Congá e membros da Casa com respeito e humildade.</li>

        <li><strong>Silêncio e concentração:</strong> Evitar conversas paralelas e manter foco no trabalho espiritual.</li>
    </ul><br>

    Essas práticas visam purificar e elevar as vibrações do médium, facilitando a incorporação harmônica e a realização
    do trabalho de caridade com a luz e a força das entidades espirituais.

</p>

        </p>
        <button onclick="document.getElementById('modal4').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>   
        </dialog>
@endsection
