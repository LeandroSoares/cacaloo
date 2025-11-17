@extends('layouts.admin')

@section('title', 'Gerenciar Convites')

@section('content')
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 sm:p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Gerenciar Convites') }}
                    </h2>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.invitations.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Novo Convite
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white text-xs sm:text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expira em</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($invitations as $invitation)
                                    <tr class="cursor-pointer hover:bg-blue-50 transition" onclick="window.location='{{ route('admin.invitations.show', $invitation) }}'">
                                        <td class="py-4 px-6 text-sm text-gray-900 font-bold">{{ $invitation->id }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-900">{{ $invitation->expires_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 px-6 text-sm text-gray-500 text-center">
                                            Nenhum convite encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyInviteLink(url) {
            navigator.clipboard.writeText(url).then(function() {
                // Criar notificação temporária
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                notification.textContent = '✓ Link copiado para a área de transferência!';
                document.body.appendChild(notification);

                // Remover após 3 segundos
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }, function(err) {
                alert('Erro ao copiar link: ' + err);
            });
        }
    </script>
    @endpush
@endsection
