@extends('layouts.user')

@section('title', $content->title)

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <article class="p-6 sm:p-10 bg-white border-b border-gray-200">
                <!-- Cabeçalho -->
                <header class="mb-8 border-b pb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl text-center mb-4">
                        {{ $content->title }}
                    </h1>

                    <div class="flex items-center justify-center text-sm text-gray-500 space-x-4">
                        <span class="px-3 py-1 bg-gray-100 rounded-full flex items-center">
                            <i class="fas fa-tag mr-2 text-oxossi-main"></i>
                            {{ $content->type->label() }}
                        </span>

                        @if($content->published_at)
                            <span class="flex items-center">
                                <i class="far fa-calendar-alt mr-2 text-gray-400"></i>
                                {{ $content->published_at->format('d/m/Y') }}
                            </span>
                        @endif
                    </div>
                </header>

                <!-- Conteúdo -->
                <div class="trix-content prose prose-lg prose-indigo mx-auto">
                    {!! $content->body !!}
                </div>

                <!-- Rodapé / Navegação -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex justify-between items-center">
                    <a href="{{ route('portal.articles') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Voltar para Artigos
                    </a>

                    <span class="text-xs text-gray-400">
                        Leitura Exclusiva do Portal
                    </span>
                </div>
            </article>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<style>
    .text-oxossi-main { color: var(--oxossi-main, #22c55e); }
    .trix-content h1 { font-size: 1.8em; font-weight: bold; margin-bottom: 0.5em; margin-top: 1.5em; color: #111827; }
    .trix-content h2 { font-size: 1.4em; font-weight: bold; margin-bottom: 0.5em; margin-top: 1.25em; color: #374151; }
    .trix-content p { margin-bottom: 1.25em; line-height: 1.75; text-align: justify; color: #374151; }
    .trix-content ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.25em; }
    .trix-content ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.25em; }
    .trix-content a { color: #4f46e5; text-decoration: underline; }
    .trix-content blockquote { border-left: 4px solid #e5e7eb; padding-left: 1em; color: #6b7280; font-style: italic; margin-top: 1.5em; margin-bottom: 1.5em; }
    .trix-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1.5rem auto; display: block; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
</style>
@endpush
@endsection
