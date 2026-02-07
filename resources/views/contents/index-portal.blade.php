@extends('layouts.user')

@section('title', 'Artigos e Trabalhos')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="mr-3 text-3xl">📚</span>
                    Biblioteca do Portal
                </h1>

                <p class="text-gray-600 mb-8">
                    Aqui você encontra materiais de estudo, trabalhos internos e orientações exclusivas para membros da casa.
                </p>

                @if($contents->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($contents as $content)
                            <a href="{{ route('portal.content', $content->slug) }}" class="group block h-full">
                                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 h-full flex flex-col bg-white hover:border-oxossi-light">
                                    <div class="h-32 bg-gray-100 flex items-center justify-center relative overflow-hidden group-hover:opacity-90 transition-opacity">
                                        <!-- Placeholder ou Imagem de Capa se tiver -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-oxossi-main/10 to-blue-500/10"></div>
                                        <span class="text-4xl">
                                            @if($content->type->value === 'trabalho') 🕯️
                                            @elseif($content->type->value === 'institucional') 🏛️
                                            @elseif($content->type->value === 'lenda') 📜
                                            @else 📄
                                            @endif
                                        </span>
                                    </div>
                                    <div class="p-5 flex-1 flex flex-col">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-semibold px-2 py-1 rounded bg-gray-100 text-gray-600 group-hover:bg-oxossi-light/20 group-hover:text-oxossi-dark transition-colors">
                                                {{ $content->type->label() }}
                                            </span>
                                            <span class="text-xs text-gray-400">
                                                {{ $content->published_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-oxossi-main transition-colors line-clamp-2">
                                            {{ $content->title }}
                                        </h3>
                                        <div class="mt-auto pt-4 flex items-center text-sm font-medium text-oxossi-main opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0 duration-300">
                                            Ler conteúdo <i class="fas fa-arrow-right ml-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $contents->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum conteúdo disponível</h3>
                        <p class="mt-1 text-sm text-gray-500">Volte mais tarde para ver novos artigos e orientações.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
