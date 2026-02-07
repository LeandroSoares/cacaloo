@extends('layouts.user')

@section('title', $content->title)

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <article class="prose prose-lg prose-indigo mx-auto bg-white p-6 sm:p-10 rounded-lg shadow-sm">
        <header class="mb-8 border-b pb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                {{ $content->title }}
            </h1>
            <div class="mt-4 flex items-center text-sm text-gray-500">
                <span class="mr-4">
                    <i class="fas fa-tag mr-1"></i> {{ $content->type->label() }}
                </span>
                @if($content->published_at)
                    <span>
                        <i class="far fa-calendar-alt mr-1"></i> {{ $content->published_at->format('d/m/Y') }}
                    </span>
                @endif
            </div>
        </header>

        <div class="trix-content">
            {!! $content->body !!}
        </div>

        @if($content->visibility === \App\Enums\ContentVisibility::PRIVATE)
            <div class="mt-8 p-4 bg-yellow-50 rounded-md text-sm text-yellow-700 border border-yellow-200">
                <i class="fas fa-lock mr-2"></i> Este é um conteúdo exclusivo para membros do portal.
            </div>
        @endif
    </article>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<style>
    /* Estilos básicos para o conteúdo renderizado pelo Trix */
    .trix-content h1 { font-size: 2em; font-weight: bold; margin-bottom: 0.5em; }
    .trix-content h2 { font-size: 1.5em; font-weight: bold; margin-bottom: 0.5em; }
    .trix-content p { margin-bottom: 1em; line-height: 1.6; }
    .trix-content ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1em; }
    .trix-content ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1em; }
    .trix-content a { color: #4f46e5; text-decoration: underline; }
    .trix-content blockquote { border-left: 4px solid #e5e7eb; padding-left: 1em; color: #4b5563; font-style: italic; }
</style>
@endpush
@endsection
