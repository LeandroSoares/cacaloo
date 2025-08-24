<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <h1 class="text-3xl font-bold text-red-600 mb-4">Acesso Não Autorizado</h1>
                            <p class="text-lg mb-6">Você não possui permissão para acessar esta página.</p>
                            <p class="mb-8">Se você acredita que deveria ter acesso, entre em contato com o administrador do sistema.</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Voltar ao Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
