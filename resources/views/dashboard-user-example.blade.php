<x-layout.app>
    <x-slot name="header">
        🌿 Portal da Casa
    </x-slot>

    <div class="space-y-6">
        <!-- Saudação Espiritual -->
        <div class="user-card animate-fade-in-up">
            <div class="flex items-center space-x-4 p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--oxossi-main), var(--oxossi-light));">
                    <span class="text-white text-2xl">🌿</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold" style="color: var(--text-primary);">
                        Axé, {{ Auth::user()->name ?? 'Irmão(ã)' }}!
                    </h2>
                    <p style="color: var(--text-secondary);" class="text-lg">
                        Bem-vindo(a) à sua jornada espiritual
                    </p>
                </div>
            </div>
        </div>

        <!-- Cards de Navegação -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Meus Dados -->
            <div class="card card--user group cursor-pointer hover:shadow-lg transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: var(--oxossi-main);">
                        <span class="text-white text-xl">👤</span>
                    </div>
                    <h3 class="text-lg font-semibold" style="color: var(--text-primary);">
                        Meus Dados
                    </h3>
                </div>
                <p style="color: var(--text-secondary);" class="text-sm">
                    Gerencie suas informações pessoais e espirituais
                </p>
            </div>

            <!-- Histórico Mediúnico -->
            <div class="card card--user group cursor-pointer hover:shadow-lg transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: var(--gold-main);">
                        <span class="text-white text-xl">📜</span>
                    </div>
                    <h3 class="text-lg font-semibold" style="color: var(--text-primary);">
                        Histórico Mediúnico
                    </h3>
                </div>
                <p style="color: var(--text-secondary);" class="text-sm">
                    Acompanhe sua evolução e desenvolvimentos espirituais
                </p>
            </div>

            <!-- Consultas e Orientações -->
            <div class="card card--user group cursor-pointer hover:shadow-lg transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: var(--forest-main);">
                        <span class="text-white text-xl">🔮</span>
                    </div>
                    <h3 class="text-lg font-semibold" style="color: var(--text-primary);">
                        Consultas
                    </h3>
                </div>
                <p style="color: var(--text-secondary);" class="text-sm">
                    Agende consultas e receba orientações espirituais
                </p>
                <div class="mt-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Em breve
                    </span>
                </div>
            </div>
        </div>

        <!-- Mensagem Inspiradora -->
        <div class="user-card bg-gradient-to-r from-green-50 to-yellow-50 border-l-4" style="border-color: var(--gold-main);">
            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: var(--gold-main);">
                        <span class="text-white text-lg">✨</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg" style="color: var(--oxossi-main);">
                            Pensamento do Dia
                        </h4>
                        <p style="color: var(--text-secondary);" class="mt-2 italic">
                            "A verdadeira espiritualidade é a que nos faz mais humanos, mais compassivos e mais unidos.
                            Que Oxóssi ilumine seus caminhos e Ogum lhe dê força para trilhá-los."
                        </p>
                        <p class="text-sm mt-3" style="color: var(--gold-main);">
                            — Casa de Caridade Legião de Oxóssi e Ogum
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status de Conexão Espiritual -->
        <div class="user-card">
            <div class="p-6">
                <h4 class="font-semibold text-lg mb-4" style="color: var(--text-primary);">
                    Conexão Espiritual
                </h4>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <span style="color: var(--text-secondary);">Conectado com a casa</span>
                    </div>
                    <span class="text-sm" style="color: var(--text-secondary);">
                        Última sincronização: {{ now()->format('d/m/Y H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
