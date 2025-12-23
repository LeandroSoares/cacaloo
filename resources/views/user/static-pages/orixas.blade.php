@extends('layouts.user')

@section('title', 'Orixás')

@section('content')
    <style>
        .orixas-hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%) !important;
            border-radius: 2rem !important;
            padding: 4rem 2rem !important;
            color: white !important;
            margin-bottom: 3rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .orixa-card {
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
            position: relative;
            overflow: hidden;
        }

        .orixa-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .orixa-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
            font-size: 2rem;
            z-index: 10;
            position: relative;
        }

        .btn-orixa {
            margin-top: auto !important;
            padding: 0.75rem 2rem !important;
            border-radius: 1rem !important;
            font-weight: 700 !important;
            transition: all 0.3s ease !important;
            color: white !important;
        }

        .side-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>

    <div class="py-6 px-4">
        <div class="orixas-hero text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">Divinos <span
                    style="color: var(--gold-main)">Orixás</span></h1>
            <p class="text-lg opacity-90 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
                As forças da natureza manifestadas em divindades que regem nossa existência, caminhos e evolução espiritual.
            </p>
        </div>

        @php
            $config = [
                'Oxalá' => ['icon' => 'fa-dove', 'bg' => '#f8fafc', 'text' => '#64748b', 'border' => '#e2e8f0', 'grad' => 'linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%)'],
                'Oiá' => ['icon' => 'fa-wind', 'bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fbbf24', 'grad' => 'linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%)'],
                'Oxum' => ['icon' => 'fa-heart', 'bg' => '#fefce8', 'text' => '#ca8a04', 'border' => '#facc15', 'grad' => 'linear-gradient(135deg, #fefce8 0%, #fef9c3 100%)'],
                'Oxumaré' => ['icon' => 'fa-rainbow', 'bg' => '#f0fdf4', 'text' => '#16a34a', 'border' => '#4ade80', 'grad' => 'linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)'],
                'Oxóssi' => ['icon' => 'fa-leaf', 'bg' => '#f0fdf4', 'text' => '#15803d', 'border' => '#22c55e', 'grad' => 'linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)'],
                'Obá' => ['icon' => 'fa-shield-heart', 'bg' => '#fef2f2', 'text' => '#b91c1c', 'border' => '#f87171', 'grad' => 'linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)'],
                'Xangô' => ['icon' => 'fa-gavel', 'bg' => '#fff7ed', 'text' => '#c2410c', 'border' => '#fb923c', 'grad' => 'linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%)'],
                'Egunitá' => ['icon' => 'fa-fire', 'bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#f87171', 'grad' => 'linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)'],
                'Ogum' => ['icon' => 'fa-shield-halved', 'bg' => '#eff6ff', 'text' => '#1d4ed8', 'border' => '#60a5fa', 'grad' => 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)'],
                'Iansã' => ['icon' => 'fa-bolt', 'bg' => '#fff7ed', 'text' => '#ea580c', 'border' => '#fb923c', 'grad' => 'linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%)'],
                'Obaluaiyê' => ['icon' => 'fa-staff-snake', 'bg' => '#fafaf9', 'text' => '#44403c', 'border' => '#a8a29e', 'grad' => 'linear-gradient(135deg, #fafaf9 0%, #f5f5f4 100%)'],
                'Nanã' => ['icon' => 'fa-spa', 'bg' => '#f5f3ff', 'text' => '#6d28d9', 'border' => '#a78bfa', 'grad' => 'linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%)'],
                'Iemanjá' => ['icon' => 'fa-water', 'bg' => '#f0f9ff', 'text' => '#0369a1', 'border' => '#38bdf8', 'grad' => 'linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%)'],
                'Omulú' => ['icon' => 'fa-skull', 'bg' => '#f5f5f4', 'text' => '#44403c', 'border' => '#a8a29e', 'grad' => 'linear-gradient(135deg, #f5f5f4 0%, #e7e5e4 100%)'],
            ];

            $default = ['icon' => 'fa-om', 'bg' => '#f8fafc', 'text' => '#64748b', 'border' => '#e2e8f0', 'grad' => 'linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%)'];
        @endphp

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($orishas as $orisha)
                @php
                    $item = $config[$orisha->name] ?? $default;
                    $typeColors = [
                        'Universal' => 'indigo',
                        'Cósmico' => 'rose',
                    ];
                    $typeColor = $typeColors[$orisha->type_orisha] ?? 'gray';
                @endphp
                <div class="orixa-card animate-fade-in-up" style="border-top: 6px solid {{ $item['border'] }}">
                    <span class="side-badge bg-{{ $typeColor }}-100 text-{{ $typeColor }}-700">
                        {{ $orisha->type_orisha }}
                    </span>

                    <div class="orixa-icon" style="background: {{ $item['bg'] }}; color: {{ $item['text'] }}">
                        <i class="fa-solid {{ $item['icon'] }}"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $orisha->name }}</h3>
                    <p class="text-xs font-black uppercase tracking-widest mb-4" style="color: {{ $item['text'] }}">
                        {{ $orisha->throne ?? 'Mistério Sagrado' }}
                    </p>

                    <p class="text-gray-600 mb-6 leading-relaxed text-sm line-clamp-3">
                        {{ $orisha->description }}
                    </p>

                    <button onclick="document.getElementById('modal-{{ $orisha->id }}').showModal()"
                        class="btn-orixa shadow-md active:scale-95" style="background: {{ $item['text'] }}">
                        Conhecer mais
                    </button>
                </div>

                <!-- Modal for each Orixá -->
                <x-modal-premium id="modal-{{ $orisha->id }}" title="{{ $orisha->name }}" subtitle="{{ $orisha->throne }}"
                    icon="fa-solid {{ $item['icon'] }}" headerGradient="{{ $item['grad'] }}"
                    headerTextColor="{{ $item['text'] }}">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-lg font-bold mb-2" style="color: {{ $item['text'] }}">Descrição</h4>
                            <p class="text-gray-700 leading-relaxed">{{ $orisha->description }}</p>
                        </div>

                        @if($orisha->text)
                            <div>
                                <h4 class="text-lg font-bold mb-2" style="color: {{ $item['text'] }}">Fundamentação</h4>
                                <div class="text-gray-700 leading-relaxed space-y-4">
                                    {!! nl2br(e($orisha->text)) !!}
                                </div>
                            </div>
                        @endif

                        @if($orisha->oferings)
                            <div class="p-4 rounded-xl bg-gray-50 border-l-4" style="border-color: {{ $item['border'] }}">
                                <h4 class="text-lg font-bold mb-2" style="color: {{ $item['text'] }}">Oferendas e Elementos</h4>
                                <p class="text-gray-700 text-sm italic">{{ $orisha->oferings }}</p>
                            </div>
                        @endif
                    </div>
                </x-modal-premium>
            @endforeach
        </div>
    </div>
@endsection