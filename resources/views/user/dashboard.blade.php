@extends('layouts.user')

@section('title', 'Portal da Casa')

@section('content')
<style>
    .portal-hero {
        background: linear-gradient(135deg, #1B4332 0%, #2E7D32 100%) !important;
        border-radius: 2rem !important;
        padding: 3rem !important;
        color: white !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        margin-bottom: 2rem !important;
        position: relative;
        overflow: hidden;
    }

    .portal-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(212, 175, 55, 0.1);
        border-radius: 50%;
        filter: blur(60px);
    }

    .nav-card {
        background: white !important;
        border-radius: 1.5rem !important;
        padding: 2rem !important;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid #F3F4F6 !important;
        height: 100%;
        text-decoration: none !important;
    }

    .nav-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05) !important;
        border-color: #E5E7EB !important;
    }

    .nav-icon {
        width: 56px;
        height: 56px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        color: white;
    }

    .quote-card {
        background: white !important;
        border-radius: 2rem !important;
        padding: 3rem !important;
        border-left: 8px solid #D4AF37 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
    }
</style>

<div class="space-y-8 pb-12">
    <!-- Saudação Espiritual -->
    <div class="user-card animate-fade-in-up">
        <div class="flex items-center space-x-4 p-6">
            <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--oxossi-main), var(--oxossi-light));">
                <span class="text-white text-2xl">🌿</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold" style="color: var(--text-primary);">
                    Axé, Administrador do Sistema!
                </h2>
                <p style="color: var(--text-secondary);" class="text-lg">
                    Bem-vindo(a) à sua jornada espiritual
                </p>
            </div>
        </div>
    </div>
 

    <!-- Cards de Navegação -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Meus Dados -->
        <a href="{{ route('user.meus-dados') }}" class="nav-card">
            <div class="nav-icon" style="background: #2E7D32;">
                <i class="fa-solid fa-user-gear"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Meus Dados</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Gerencie suas informações cadastrais e religiosas.</p>
        </a>

        <!-- Histórico Mediúnico -->
        <a href="{{ route('user.medium-history') }}" class="nav-card">
            <div class="nav-icon" style="background: #D4AF37;">
                <i class="fa-solid fa-scroll"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Jornada Espiritual</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Acompanhe sua evolução e atendimentos na casa.</p>
        </a>

        <!-- Orientações Casa -->
        <a href="{{ route('user.orientacoes-casa') }}" class="nav-card">
            <div class="nav-icon" style="background: #1e3a8a;">
                <i class="fa-solid fa-house-chimney-medical"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Orientações Casa</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Normas, diretrizes e mandamentos do nosso solo sagrado.</p>
        </a>

        <!-- Guias -->
        <a href="{{ route('user.guias') }}" class="nav-card">
            <div class="nav-icon" style="background: #15803d;">
                <i class="fa-solid fa-dove"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">As Sete Linhas</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Conheça as falanges e os guias que regem os trabalhos.</p>
        </a>

        <!-- Lendas -->
        <a href="{{ route('user.lendas') }}" class="nav-card">
            <div class="nav-icon" style="background: #B45309;">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Folclore & Lendas</h3>
            <p class="text-gray-500 text-sm leading-relaxed">A riqueza dos mitos e lendas da nossa terra Brasil.</p>
        </a>

        <!-- Orixás -->
        <a href="{{ route('user.orixas') }}" class="nav-card">
            <div class="nav-icon" style="background: #e11d48;">
                <i class="fa-solid fa-sun"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Divinos Orixás</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Conheça as forças regentes da natureza e do terreiro.</p>
        </a>

        <!-- Orientações Médiuns -->
        <a href="{{ route('user.orientacoes-mediuns') }}" class="nav-card">
            <div class="nav-icon" style="background: #4338CA;">
                <i class="fa-solid fa-hands-praying"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Conduta & Preparo</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Dicas e obrigações para o desenvolvimento mediúnico.</p>
        </a>
        <!-- Orixás -->
        <a href="{{ route('user.orixas') }}" class="nav-card">
            <div class="nav-icon" style="background: #4338CA;">
                <i class="fa-solid fa-hands-praying"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Orixás</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Conheça as entidades que regem os trabalhos.</p>
        </a>
    </div>

    <!-- Mensagem Inspiradora -->
    <div class="user-card bg-gradient-to-r from-green-50 to-yellow-50 border-l-4" style="border-color: var(--gold-main);">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: var(--gold-main);">
                    <span class="text-white text-lg">✨</span>
                </div>
                <div>
                     @if($dailyMessage)
                    <h4 class="text-2xl font-bold mb-4" style="color: #2E7D32;">{{ $dailyMessage->title }}</h4>
                    <p class="text-xl text-gray-700 italic leading-relaxed whitespace-pre-line mb-6">
                        {{ $dailyMessage->message }}
                    </p>
                    @if($dailyMessage->author)
                        <div class="text-right text-gold-dark font-bold text-lg">— {{ $dailyMessage->author }}</div>
                    @endif
                @else
                    <h4 class="text-2xl font-bold mb-4" style="color: #2E7D32;">Sabedoria do Dia</h4>
                    <p class="text-xl text-gray-700 italic leading-relaxed mb-6">
                        "A mediunidade é uma oportunidade bendita de servir. Seja o canal da paz onde houver discórdia e da luz onde houver trevas."
                    </p>
                    <div class="text-right text-gold-dark font-bold text-lg">— Caboclo das Sete Encruzilhadas</div>
                @endif
                </div>
            </div>
        </div>
    </div>



     
</div>
@endsection
