<?php $__env->startSection('title', 'Customização da Homepage'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="admin-card">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">🏠 Customização da Homepage</h1>
                    <p class="text-gray-600 mt-1">
                        Configure textos, imagens e visibilidade das seções da página inicial
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="<?php echo e(url('/')); ?>" target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        👀 Visualizar Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form id="home-customization-form" action="<?php echo e(route('admin.home-customization.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>

        <!-- Seção Hero -->
        <div class="admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        🎯 Seção Hero (Topo)
                    </h2>
                    <label class="flex items-center">
                        <input type="hidden" name="hero_visible" value="0">
                        <input type="checkbox" name="hero_visible" value="1"
                               <?php echo e(($homeData['hero']['is_visible'] ?? true) ? 'checked' : ''); ?>

                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Título - Linha 1 (Branca)
                        </label>
                        <input type="text"
                               name="hero_title_line1"
                               id="hero_title_line1"
                               value="<?php echo e(old('hero_title_line1', $homeData['hero']['title_line1'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ex: Casa de Caridade">
                        <p class="text-xs text-gray-500 mt-1">Deixe vazio para não exibir esta linha</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Título - Linha 2 (Dourada)
                        </label>
                        <input type="text"
                               name="hero_title_line2"
                               id="hero_title_line2"
                               value="<?php echo e(old('hero_title_line2', $homeData['hero']['title_line2'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ex: Legião de Oxóssi e Ogum">
                        <p class="text-xs text-gray-500 mt-1">Deixe vazio para não exibir esta linha</p>
                    </div>

                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Subtítulo
                        </label>
                        <input type="text"
                               name="hero_subtitle"
                               id="hero_subtitle"
                               value="<?php echo e(old('hero_subtitle', $homeData['hero']['subtitle'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ex: Um espaço de acolhimento, caridade e conexão espiritual">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Cor de Fundo (Hex)
                        </label>
                        <input type="color"
                               name="hero_background_color"
                               id="hero_background_color"
                               value="<?php echo e(old('hero_background_color', $homeData['hero']['background_color'] ?? '#2E7D32')); ?>"
                               class="w-full h-10 border border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem de Fundo
                        </label>
                        <input type="file"
                               name="hero_background_image"
                               id="hero_background_image"
                               accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                        <input type="hidden" name="about_visible" value="0">
                        <input type="checkbox" name="about_visible" value="1"
                               <?php echo e(($homeData['about']['is_visible'] ?? true) ? 'checked' : ''); ?>

                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Título da Seção *
                        </label>
                        <input type="text"
                               name="about_title"
                               id="about_title"
                               value="<?php echo e(old('about_title', $homeData['about']['title'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Subtítulo da Seção
                        </label>
                        <input type="text"
                               name="about_subtitle"
                               id="about_subtitle"
                               value="<?php echo e(old('about_subtitle', $homeData['about']['subtitle'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Cards Configuráveis -->
                <div id="cards-container" class="space-y-4">
                    <?php $__currentLoopData = $homeData['about']['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card-item bg-gray-50 rounded-lg p-4" data-card-index="<?php echo e($index); ?>">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-medium text-gray-900">Card <?php echo e($index + 1); ?></h4>
                            <div class="flex items-center space-x-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="about_cards[<?php echo e($index); ?>][is_visible]" value="1" checked
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
                                <input type="text" name="about_cards[<?php echo e($index); ?>][title]"
                                       value="<?php echo e($card['title']); ?>"
                                       class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                       required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Ícone
                                </label>
                                <select name="about_cards[<?php echo e($index); ?>][icon]"
                                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="book" <?php echo e(($card['icon'] ?? '') == 'book' ? 'selected' : ''); ?>>📖 Livro</option>
                                    <option value="hands" <?php echo e(($card['icon'] ?? '') == 'hands' ? 'selected' : ''); ?>>🤝 Mãos</option>
                                    <option value="heart" <?php echo e(($card['icon'] ?? '') == 'heart' ? 'selected' : ''); ?>>❤️ Coração</option>
                                    <option value="star" <?php echo e(($card['icon'] ?? '') == 'star' ? 'selected' : ''); ?>>⭐ Estrela</option>
                                    <option value="leaf" <?php echo e(($card['icon'] ?? '') == 'leaf' ? 'selected' : ''); ?>>🌿 Folha</option>
                                    <option value="sun" <?php echo e(($card['icon'] ?? '') == 'sun' ? 'selected' : ''); ?>>☀️ Sol</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Ordem
                                </label>
                                <input type="number" name="about_cards[<?php echo e($index); ?>][sort_order]"
                                       value="<?php echo e($index); ?>" min="0" max="10"
                                       class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Conteúdo do Card *
                                </label>
                                <textarea name="about_cards[<?php echo e($index); ?>][content]" rows="3"
                                          class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                          required><?php echo e($card['content']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <input type="hidden" name="events_visible" value="0">
                        <input type="checkbox" name="events_visible" value="1"
                               <?php echo e(($homeData['events']['is_visible'] ?? true) ? 'checked' : ''); ?>

                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Título da Seção *
                        </label>
                        <input type="text"
                               name="events_title"
                               id="events_title"
                               value="<?php echo e(old('events_title', $homeData['events']['title'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Subtítulo da Seção
                        </label>
                        <input type="text"
                               name="events_subtitle"
                               id="events_subtitle"
                               value="<?php echo e(old('events_subtitle', $homeData['events']['subtitle'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
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
                        <input type="hidden" name="contact_visible" value="0">
                        <input type="checkbox" name="contact_visible" value="1"
                               <?php echo e(($homeData['contact']['is_visible'] ?? true) ? 'checked' : ''); ?>

                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Seção visível</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Título da Seção *
                        </label>
                        <input type="text"
                               name="contact_title"
                               id="contact_title"
                               value="<?php echo e(old('contact_title', $homeData['contact']['title'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Subtítulo da Seção
                        </label>
                        <input type="text"
                               name="contact_subtitle"
                               id="contact_subtitle"
                               value="<?php echo e(old('contact_subtitle', $homeData['contact']['subtitle'] ?? '')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Conteúdo Adicional
                        </label>
                        <textarea name="contact_content" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Texto adicional para exibir na seção de contato..."><?php echo e(old('contact_content', $homeData['contact']['content'] ?? '')); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões de Ação -->
        <div class="admin-card">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <button type="button" onclick="resetForm()"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        🔄 Restaurar Padrões
                    </button>

                    <div class="flex space-x-3">
                        <a href="<?php echo e(route('admin.dashboard')); ?>"
                           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            ← Voltar
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            💾 Salvar Alterações
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let cardCounter = <?php echo e(count($homeData['about']['cards'] ?? [])); ?>;

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

    cardDiv.innerHTML = '<div class="flex items-center justify-between mb-4">' +
        '<h4 class="font-medium text-gray-900">Card ' + cardNumber + '</h4>' +
        '<div class="flex items-center space-x-3">' +
            '<label class="flex items-center">' +
                '<input type="checkbox" name="about_cards[' + cardIndex + '][is_visible]" value="1" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">' +
                '<span class="ml-2 text-sm text-gray-700">Visível</span>' +
            '</label>' +
            '<button type="button" onclick="removeCard(this)" class="text-red-600 hover:text-red-800 p-1" title="Remover card">' +
                '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>' +
                '</svg>' +
            '</button>' +
        '</div>' +
    '</div>' +
    '<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">' +
        '<div>' +
            '<label class="block text-sm font-medium text-gray-700 mb-1">Título do Card *</label>' +
            '<input type="text" name="about_cards[' + cardIndex + '][title]" placeholder="Digite o título..." class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>' +
        '</div>' +
        '<div>' +
            '<label class="block text-sm font-medium text-gray-700 mb-1">Ícone</label>' +
            '<select name="about_cards[' + cardIndex + '][icon]" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">' +
                '<option value="book">📖 Livro</option>' +
                '<option value="hands">🤝 Mãos</option>' +
                '<option value="heart">❤️ Coração</option>' +
                '<option value="star">⭐ Estrela</option>' +
                '<option value="leaf">🌿 Folha</option>' +
                '<option value="sun">☀️ Sol</option>' +
            '</select>' +
        '</div>' +
        '<div>' +
            '<label class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>' +
            '<input type="number" name="about_cards[' + cardIndex + '][sort_order]" value="' + cardIndex + '" min="0" max="10" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">' +
        '</div>' +
        '<div class="lg:col-span-3">' +
            '<label class="block text-sm font-medium text-gray-700 mb-1">Conteúdo do Card *</label>' +
            '<textarea name="about_cards[' + cardIndex + '][content]" rows="3" placeholder="Digite o conteúdo do card..." class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" required></textarea>' +
        '</div>' +
    '</div>';

    container.appendChild(cardDiv);
    cardCounter++;
    updateCardNumbers();

    // Scroll suave para o novo card
    cardDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // Foco no campo título
    const titleInput = cardDiv.querySelector('input[type="text"]');
    setTimeout(function() { titleInput.focus(); }, 300);
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
    cards.forEach(function(card, index) {
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/admin/home-customization/index.blade.php ENDPATH**/ ?>