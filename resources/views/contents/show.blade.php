<x-layout.app>
    <x-slot name="title">
        {{ $content->title }} - Casa de Caridade Legião de Oxóssi e Ogum
    </x-slot>

    <!-- Background Image -->
    <div class="fixed inset-0 z-[-1]">
        <img src="{{ asset('images/floresta1.jpg') }}" alt="Background Floresta" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gray-900/40"></div> <!-- Overlay escuro suave -->
    </div>

    <div class="relative max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <article class="prose prose-lg prose-indigo mx-auto bg-white p-6 sm:p-10 rounded-lg shadow-sm">
            <header class="mb-8 border-b pb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl text-center">
                    {{ $content->title }}
                </h1>
                <div class="mt-4 flex items-center justify-center text-sm text-gray-500">
                    <span class="mr-4 px-3 py-1 bg-gray-100 rounded-full">
                        <i class="fas fa-tag mr-1 text-oxossi-main"></i> {{ $content->type->label() }}
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

        <div class="mt-8 text-center">
            <a href="/" class="text-white hover:text-gray-200 font-medium inline-flex items-center px-4 py-2 bg-black/30 rounded-full hover:bg-black/50 transition duration-300">
                &larr; Voltar para a Home
            </a>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <style>
        .text-oxossi-main { color: var(--oxossi-main, #22c55e); }
        .trix-content h1 { font-size: 2em; font-weight: bold; margin-bottom: 0.5em; margin-top: 1em; }
        .trix-content h2 { font-size: 1.5em; font-weight: bold; margin-bottom: 0.5em; margin-top: 1em; }
        .trix-content p { margin-bottom: 1em; line-height: 1.6; text-align: justify; }
        .trix-content ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1em; }
        .trix-content ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1em; }
        .trix-content a { color: #4f46e5; text-decoration: underline; }
        .trix-content blockquote { border-left: 4px solid #e5e7eb; padding-left: 1em; color: #4b5563; font-style: italic; }
        .trix-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
    </style>
    @endpush
</x-layout.app>
