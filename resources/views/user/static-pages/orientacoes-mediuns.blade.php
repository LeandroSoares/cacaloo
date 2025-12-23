@extends('layouts.user')

@section('title', 'Orientações do Médium')

@section('content')
<style>
    .medium-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #312e81 50%, #4338CA 100%) !important;
        border-radius: 2rem !important;
        padding: 4rem 2rem !important;
        color: white !important;
        margin-bottom: 3rem !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
    }

    .medium-card {
        background: white !important;
        border-radius: 1.5rem !important;
        border: 1px solid #E5E7EB !important;
        padding: 2.5rem !important;
        transition: all 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
    }

    .medium-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
    }

    .medium-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 1.25rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 1.5rem !important;
        font-size: 1.75rem !important;
    }

    .btn-medium {
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

    .info-section {
        background: #F9FAFB;
        border-radius: 1.5rem;
        padding: 1.5rem;
        border-left: 6px solid #4338CA;
    }
</style>

<div class="py-6 px-4 animate-fade-in">
    <!-- Hero Section -->
    <div class="medium-hero">
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight">Caminhada <span style="color: #F4D365">Mediúnica</span></h1>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl leading-relaxed">
                A mediunidade é um compromisso sagrado com a caridade e a evolução espiritual. Siga as orientações para manter seu equilíbrio e sua conexão com a luz.
            </p>
        </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Card 1 – Conduta -->
        <div class="medium-card" style="border-top: 8px solid #2563EB">
            <div class="medium-icon-box" style="background: #EFF6FF; color: #2563EB">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Conduta do Médium</h3>
            <span class="text-xs font-black text-blue-700 uppercase tracking-widest mb-4 block">Ética & Postura</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Diretrizes para o equilíbrio emocional, disciplina espiritual e postura adequada dentro e fora do templo.</p>
            <button onclick="document.getElementById('modal2').showModal()" class="btn-medium shadow-lg active:scale-95" style="background: #2563EB">LER DIRETRIZES</button>
        </div>

        <!-- Card 2 – Disciplina -->
        <div class="medium-card" style="border-top: 8px solid #059669">
            <div class="medium-icon-box" style="background: #ECFDF5; color: #059669">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Disciplina Ritualística</h3>
            <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 block">Regras & Hierarquia</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Obrigações espirituais, horários, respeito às hierarquias e a importância da ordem no desenvolvimento.</p>
            <button onclick="document.getElementById('modal3').showModal()" class="btn-medium shadow-lg active:scale-95" style="background: #059669">LER REGRAS</button>
        </div>

        <!-- Card 3 – Preparação -->
        <div class="medium-card" style="border-top: 8px solid #DC2626">
            <div class="medium-icon-box" style="background: #FEF2F2; color: #DC2626">
                <i class="fa-solid fa-vial-circle-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Preparação Espiritual</h3>
            <span class="text-xs font-black text-red-700 uppercase tracking-widest mb-4 block">Limpeza & Preparo</span>
            <p class="text-gray-600 mb-6 leading-relaxed">Banhos de descarrego, alimentação, limpeza energética e cuidados essenciais antes dos trabalhos.</p>
            <button onclick="document.getElementById('modal4').showModal()" class="btn-medium shadow-lg active:scale-95" style="background: #DC2626">LER PREPARO</button>
        </div>

    </div>
</div>

<!-- MODAIS -->

<!-- Modal 1 - Conduta -->
<x-modal-premium 
    id="modal2" 
    title="Conduta do Médium" 
    subtitle="Compromisso e Ética Espiritual" 
    icon="fa-solid fa-user-check" 
    headerGradient="linear-gradient(135deg, #2563EB 0%, #1e3a8a 100%)"
>
    <div class="info-section">
        <p>A mediunidade é um compromisso sagrado. A conduta do médium reflete sua sintonia com a espiritualidade superior.</p>
    </div>
    
    <h3 class="text-2xl font-bold text-blue-900">Dentro do Terreiro</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Silêncio e Respeito:</strong> Ambiente de oração constante. Evite conversas paralelas.</li>
        <li><strong>Assiduidade:</strong> Sua presença fortalece a corrente mediúnica.</li>
        <li><strong>Postura:</strong> Mantenha a dignidade durante a incorporação, sem exibicionismos.</li>
    </ul>

    <h3 class="text-2xl font-bold text-blue-900">Fora do Terreiro</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Moralidade:</strong> Seja um exemplo de retidão em sua vida cotidiana.</li>
        <li><strong>Discrição:</strong> Não use o nome da casa ou sua mediunidade para vantagens pessoais.</li>
    </ul>
</x-modal-premium>

<!-- Modal 2 - Disciplina -->
<x-modal-premium 
    id="modal3" 
    title="Disciplina Ritualística" 
    subtitle="Regras e Hierarquia Sagrada" 
    icon="fa-solid fa-list-check" 
    headerGradient="linear-gradient(135deg, #059669 0%, #064e3b 100%)"
>
    <div class="info-section">
        <p>A disciplina é o pilar que sustenta a ordem e a segurança dos trabalhos espirituais.</p>
    </div>

    <h3 class="text-2xl font-bold text-green-900">Horários e Presença</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Pontualidade:</strong> Chegar com antecedência para preparação pessoal.</li>
        <li><strong>Saudação:</strong> Respeitar os pontos de força (Porteira, Congá) ao entrar.</li>
    </ul>

    <h3 class="text-2xl font-bold text-green-900">Hierarquia</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Obediência:</strong> Seguir as orientações dos dirigentes e guias chefes.</li>
        <li><strong>União:</strong> Evitar fofocas ou intrigas que desestabilizem a corrente.</li>
    </ul>
</x-modal-premium>

<!-- Modal 3 - Preparação -->
<x-modal-premium 
    id="modal4" 
    title="Preparação Espiritual" 
    subtitle="Limpeza e Fortalecimento Energético" 
    icon="fa-solid fa-vial-circle-check" 
    headerGradient="linear-gradient(135deg, #DC2626 0%, #991B1B 100%)"
>
    <div class="info-section">
        <p>O preparo começa horas antes do trabalho, purificando o corpo e elevando a mente.</p>
    </div>

    <h3 class="text-2xl font-bold text-red-900">Corpo Físico</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Alimentação:</strong> Evitar carnes pesadas e bebidas alcoólicas antes da gira.</li>
        <li><strong>Descanso:</strong> Estar descansado para manter a concentração necessária.</li>
    </ul>

    <h3 class="text-2xl font-bold text-red-900">Corpo Energético</h3>
    <ul class="list-disc pl-6 space-y-3">
        <li><strong>Banhos:</strong> Realizar os banhos de ervas recomendados pela casa.</li>
        <li><strong>Velas:</strong> Firmar seu anjo de guarda e proteções conforme orientação.</li>
    </ul>
</x-modal-premium>

@endsection
