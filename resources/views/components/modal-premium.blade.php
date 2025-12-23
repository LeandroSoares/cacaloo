@props([
    'id',
    'title',
    'subtitle' => null,
    'icon' => null,
    'headerGradient' => 'linear-gradient(135deg, #1e3a8a 0%, #312e81 100%)',
    'headerTextColor' => 'white',
    'maxWidth' => 'max-w-4xl'
])

<dialog id="{{ $id }}" class="rounded-3xl p-0 w-11/12 md:w-2/3 {{ $maxWidth }} h-[90vh] md:h-auto md:max-h-[90vh] overflow-hidden border-0 shadow-2xl premium-modal">
    <div class="flex flex-col h-full">
        <!-- Header (Fixed) -->
        <div class="premium-modal-header shrink-0 shadow-lg z-20" style="background: {{ $headerGradient }}; padding: 2rem 2.5rem; color: {{ $headerTextColor }}; position: relative;">
            <button onclick="document.getElementById('{{ $id }}').close()" class="absolute top-6 right-8 text-current opacity-70 hover:opacity-100 transition-all text-4xl leading-none focus:outline-none" aria-label="Fechar">&times;</button>
            
            <div class="flex items-center space-x-4 mb-2">
                @if($icon)
                    <i class="{{ $icon }} text-3xl md:text-4xl"></i>
                @endif
                <h2 class="text-2xl md:text-4xl font-extrabold tracking-tight leading-tight">{{ $title }}</h2>
            </div>
            
            @if($subtitle)
                <p class="font-black uppercase tracking-widest text-xs opacity-80">{{ $subtitle }}</p>
            @endif
        </div>

        <!-- Body Wrapper (Flexible) -->
        <div class="bg-white flex flex-col min-h-0 grow relative">
            <!-- Scrollable Content -->
            <div class="modal-content-scroll prose max-w-none overflow-y-auto p-6 md:p-10 pb-0 grow text-gray-800 leading-relaxed text-lg space-y-6">
                {{ $slot }}
            </div>
            
            <!-- Footer (Fixed) -->
            <div class="p-6 md:p-8 shrink-0 flex justify-center bg-white border-t border-gray-100 z-10 mt-4">
                <button style="background: {{ $headerGradient }}; color: {{ $headerTextColor }};" onclick="document.getElementById('{{ $id }}').close()" class="px-10 md:px-12 py-3 md:py-4 font-black rounded-full hover:opacity-90 active:scale-95 transition-all shadow-lg uppercase tracking-widest text-sm">
                    FECHAR
                </button>
            </div>
        </div>
    </div>
</dialog>

<style>
    .premium-modal::backdrop {
        background: rgba(0, 0, 0, 0.85) !important;
        backdrop-filter: blur(10px) !important;
    }

    .modal-content-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .modal-content-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .modal-content-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .modal-content-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
