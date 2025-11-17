@extends('layouts.admin')

@section('title', 'Detalhes do Convite')

@section('content')
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <!-- Header com Ações -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    📧 Detalhes do Convite
                </h2>
                <a href="{{ route('admin.invitations.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    ← Voltar
                </a>
            </div>

            <!-- Card de Informações -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 sm:p-6">
                    <!-- Status Badge -->
                    <div class="mb-6">
                        @if ($invitation->isAccepted())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                ✓ Convite Aceito
                            </span>
                        @elseif ($invitation->isExpired())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                ⚠ Convite Expirado
                            </span>
                        @elseif ($invitation->isCancelled())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                ✕ Convite Cancelado
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                ⏳ Convite Pendente
                            </span>
                        @endif
                    </div>

                    <!-- Informações do Convidado -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                                👤 Informações do Convidado
                            </h3>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nome</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->name ?? 'Anônimo' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">E-mail</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->email ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">WhatsApp</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->whatsapp ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                                📅 Informações do Convite
                            </h3>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Convidado por</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->inviter->name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Data de Criação</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->created_at->format('d/m/Y H:i') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Data de Expiração</label>
                                    <p class="mt-1 text-gray-900">{{ $invitation->expires_at->format('d/m/Y H:i') }}</p>
                                </div>

                                @if($invitation->isAccepted())
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Aceito em</label>
                                        <p class="mt-1 text-gray-900">{{ $invitation->accepted_at->format('d/m/Y H:i') }}</p>
                                    </div>

                                    @if($invitation->acceptedBy)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Aceito por</label>
                                            <p class="mt-1 text-gray-900">{{ $invitation->acceptedBy->name }}</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Link do Convite -->
                    @if(!$invitation->isAccepted() && !$invitation->isExpired() && !$invitation->isCancelled())
                        <div class="mt-6 p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <label class="block text-sm font-medium text-blue-800 mb-2">🔗 Link do Convite</label>
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:space-x-2 mb-3">
                                <input type="text"
                                       id="inviteLink"
                                       readonly
                                       value="{{ route('register', ['token' => $invitation->token]) }}"
                                       class="w-full sm:flex-1 px-3 py-2 border border-blue-300 rounded-md bg-white text-sm">
                                <button type="button"
                                        onclick="copyInviteLink()"
                                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 whitespace-nowrap">
                                    📋 Copiar
                                </button>
                            </div>
                            <form action="GET" submit="https://wa.me/">
                                <label for="text" class="block text-sm font-medium text-blue-800 mb-2">Mensagem do convite</label>
                                <textarea id="text" name="text" rows="3" class="w-full px-3 py-2 border border-blue-300 rounded-md bg-white text-sm mb-2">
                                    Olá{{ $invitation->name ? ' ' . $invitation->name : '' }}! Você foi convidado para se juntar ao nosso sistema. Acesse o link: {{ route('register', ['token' => $invitation->token]) }}
                                </textarea>
                                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold mt-2">📱 Compartilhar via WhatsApp</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ações -->
            @if(!$invitation->isAccepted() && !$invitation->isExpired() && !$invitation->isCancelled())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">
                            ⚡ Ações Rápidas
                        </h3>

                        <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:gap-3">
                            <!-- Enviar via WhatsApp -->
                            @if($invitation->whatsapp)
                                <a href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/[^0-9]/', '', $invitation->whatsapp) }}&text={{ urlencode('Olá' . ($invitation->name ? ' ' . $invitation->name : '') . '! Você foi convidado para se juntar ao nosso sistema. Acesse o link: ' . route('register', ['token' => $invitation->token])) }}"
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                    📱 Enviar via WhatsApp
                                </a>
                            @endif

                            <!-- Reenviar Email -->
                            @if($invitation->email)
                                <form action="{{ route('admin.invitations.resend', $invitation) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                        📧 Reenviar E-mail
                                    </button>
                                </form>
                            @endif

                            <!-- Cancelar Convite -->
                            <form action="{{ route('admin.invitations.cancel', $invitation) }}"
                                  method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja cancelar este convite?');"
                                  class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700">
                                    ❌ Cancelar Convite
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Ação de Exclusão (sempre disponível) -->
            <div class="mt-6">
                <form action="{{ route('admin.invitations.destroy', $invitation) }}"
                      method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir este convite permanentemente?');">

                    @method('DELETE')
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        🗑️ Excluir Convite
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyInviteLink() {
            const input = document.getElementById('inviteLink');
            input.select();
            input.setSelectionRange(0, 99999); // Para dispositivos móveis

            navigator.clipboard.writeText(input.value).then(function() {
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
