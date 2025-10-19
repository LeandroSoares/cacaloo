@extends('layouts.admin')

@section('title', 'Customização da Homepage')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            🏠 Customização da Homepage
                        </h1>
                        <p class="text-gray-600 mt-1">
                            Configure textos, imagens e visibilidade das seções da página inicial
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ url('/') }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            👀 Visualizar Site
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <form id="home-customization-form" action="{{ route('admin.home-customization.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Seção Hero -->
            <div class="admin-card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            🌟 Seção Principal (Hero)
                        </h2>
                        <label class="flex items-center">
                            <input type="checkbox" name="hero[is_visible]" value="1" checked
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Título Principal *
                            </label>
                            <input type="text" name="hero[title]"
                                value="{{ $homeData['hero']['title'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtítulo
                            </label>
                            <input type="text" name="hero[subtitle]"
                                value="{{ $homeData['hero']['subtitle'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Imagem de Fundo
                            </label>
                            <div class="flex items-center space-x-4">
                                <input type="file" name="hero[background_image]" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @if($homeData['hero']['background_image'])
                                    <span class="text-sm text-gray-500">Atual: {{ basename($homeData['hero']['background_image']) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção Sobre -->
            <div class="admin-card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            📋 Seção Sobre
                        </h2>
                        <label class="flex items-center">
                            <input type="checkbox" name="about[is_visible]" value="1" checked
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Título da Seção *
                            </label>
                            <input type="text" name="about[title]"
                                value="{{ $homeData['about']['title'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtítulo
                            </label>
                            <input type="text" name="about[subtitle]"
                                value="{{ $homeData['about']['subtitle'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Cards da Seção Sobre -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cards da Seção</h3>

                        @foreach($homeData['about']['cards'] as $index => $card)
                                        <!-- Cards Configuráveis -->
                    <div id="cards-container" class="space-y-4">
                        @foreach($homeData['about']['cards'] as $index => $card)
                        <div class="card-item bg-gray-50 rounded-lg p-4" data-card-index="{{ $index }}">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-medium text-gray-900">Card {{ $index + 1 }}</h4>
                                <div class="flex items-center space-x-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="about_cards[{{ $index }}][is_visible]" value="1" checked
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Visível</span>
                                    </label>
                                    <button type="button" onclick="removeCard(this)"
                                            class="text-red-600 hover:text-red-800 p-1" title="Remover card">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Título do Card *
                                    </label>
                                    <input type="text" name="about_cards[{{ $index }}][title]"
                                        value="{{ $card['title'] }}"
                                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Ícone
                                    </label>
                                    <select name="about_cards[{{ $index }}][icon]"
                                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="book" {{ ($card['icon'] ?? '') == 'book' ? 'selected' : '' }}>📖 Livro</option>
                                        <option value="hands" {{ ($card['icon'] ?? '') == 'hands' ? 'selected' : '' }}>🤝 Mãos</option>
                                        <option value="heart" {{ ($card['icon'] ?? '') == 'heart' ? 'selected' : '' }}>❤️ Coração</option>
                                        <option value="star" {{ ($card['icon'] ?? '') == 'star' ? 'selected' : '' }}>⭐ Estrela</option>
                                        <option value="leaf" {{ ($card['icon'] ?? '') == 'leaf' ? 'selected' : '' }}>🌿 Folha</option>
                                        <option value="sun" {{ ($card['icon'] ?? '') == 'sun' ? 'selected' : '' }}>☀️ Sol</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Ordem
                                    </label>
                                    <input type="number" name="about_cards[{{ $index }}][sort_order]"
                                        value="{{ $index }}" min="0" max="10"
                                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Conteúdo do Card *
                                    </label>
                                    <textarea name="about_cards[{{ $index }}][content]" rows="3"
                                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                            required>{{ $card['content'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Botão Adicionar Card -->
                    <div class="mt-4">
                        <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                                onclick="addCard()">
                            ➕ Adicionar Card
                        </button>
                        <p class="text-xs text-gray-500 mt-1">Máximo: 6 cards</p>
                    </div>
                </div>
            </div>

            <!-- Seção Eventos -->
            <div class="admin-card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            📅 Seção Eventos
                        </h2>
                        <label class="flex items-center">
                            <input type="checkbox" name="events[is_visible]" value="1" checked
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Título da Seção *
                            </label>
                            <input type="text" name="events[title]"
                                value="{{ $homeData['events']['title'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtítulo
                            </label>
                            <input type="text" name="events[subtitle]"
                                value="{{ $homeData['events']['subtitle'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-800">
                            💡 <strong>Dica:</strong> Os eventos são gerenciados separadamente na seção "Eventos e Giras".
                            Aqui você configura apenas o título e subtítulo da seção.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção Contato -->
            <div class="admin-card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            📞 Seção Contato
                        </h2>
                        <label class="flex items-center">
                            <input type="checkbox" name="contact[is_visible]" value="1" checked
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Título da Seção *
                            </label>
                            <input type="text" name="contact[title]"
                                value="{{ $homeData['contact']['title'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtítulo
                            </label>
                            <input type="text" name="contact[subtitle]"
                                value="{{ $homeData['contact']['subtitle'] }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-800">
                            💡 <strong>Dica:</strong> Os dados de contato (telefone, email, endereço) são gerenciados
                            separadamente na seção "Configurações do Site".
                        </p>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="admin-card">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            💾 Lembre-se de salvar as alterações antes de sair da página
                        </div>
                        <div class="flex space-x-3">
                            <button type="button"
                                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors"
                                    onclick="resetForm()">
                                🔄 Restaurar
                            </button>
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                💾 Salvar Configurações
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    let cardCounter = {{ count($homeData['about']['cards'] ?? []) }};

    // Função para adicionar novo card
    function addCard() {
        const container = document.getElementById('cards-container');
        const currentCards = container.querySelectorAll('.card-item').length;

        if (currentCards >= 6) {
            alert('Máximo de 6 cards permitidos');
            return;
        }

        const cardIndex = cardCounter;
        const cardNumber = currentCards + 1;

        // Criar elemento do card
        const cardDiv = document.createElement('div');
        cardDiv.className = 'card-item bg-gray-50 rounded-lg p-4';
        cardDiv.setAttribute('data-card-index', cardIndex);

        cardDiv.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-medium text-gray-900">Card ${cardNumber}</h4>
                <div class="flex items-center space-x-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="about_cards[${cardIndex}][is_visible]" value="1" checked
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Visível</span>
                    </label>
                    <button type="button" onclick="removeCard(this)"
                            class="text-red-600 hover:text-red-800 p-1" title="Remover card">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Título do Card *
                    </label>
                    <input type="text" name="about_cards[${cardIndex}][title]"
                        placeholder="Digite o título..."
                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ícone
                    </label>
                    <select name="about_cards[${cardIndex}][icon]"
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="book">📖 Livro</option>
                        <option value="hands">🤝 Mãos</option>
                        <option value="heart">❤️ Coração</option>
                        <option value="star">⭐ Estrela</option>
                        <option value="leaf">🌿 Folha</option>
                        <option value="sun">☀️ Sol</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ordem
                    </label>
                    <input type="number" name="about_cards[${cardIndex}][sort_order]"
                        value="${cardIndex}" min="0" max="10"
                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Conteúdo do Card *
                    </label>
                    <textarea name="about_cards[${cardIndex}][content]" rows="3"
                            placeholder="Digite o conteúdo do card..."
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            required></textarea>
                </div>
            </div>
        `;

        container.appendChild(cardDiv);
        cardCounter++;
        updateCardNumbers();

        // Scroll suave para o novo card
        cardDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Foco no campo título
        const titleInput = cardDiv.querySelector('input[type="text"]');
        setTimeout(() => titleInput.focus(), 300);
    }

    // Função para remover card
    function removeCard(button) {
        if (confirm('Tem certeza que deseja remover este card?')) {
            const cardItem = button.closest('.card-item');
            cardItem.remove();
            updateCardNumbers();
        }
    }

    // Atualiza numeração dos cards
    function updateCardNumbers() {
        const cards = document.querySelectorAll('.card-item');
        cards.forEach((card, index) => {
            const title = card.querySelector('h4');
            title.textContent = 'Card ' + (index + 1);
        });
    }

    // Reset do formulário
    function resetForm() {
        if (confirm('Tem certeza que deseja restaurar todas as configurações? As alterações não salvas serão perdidas.')) {
            location.reload();
        }
    }

    // Validação do formulário
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('home-customization-form');

        if (form) {
            form.addEventListener('submit', function(e) {
                const cards = document.querySelectorAll('.card-item');
                let hasError = false;

                cards.forEach(function(card) {
                    const titleInput = card.querySelector('input[type="text"]');
                    const contentTextarea = card.querySelector('textarea');

                    if (!titleInput.value.trim() || !contentTextarea.value.trim()) {
                        hasError = true;
                        titleInput.style.borderColor = '#ef4444';
                        contentTextarea.style.borderColor = '#ef4444';
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    alert('Preencha todos os campos obrigatórios dos cards!');
                    return false;
                }
            });
        }

        console.log('Home Customization loaded with', cardCounter, 'cards');
    });
    </script>
