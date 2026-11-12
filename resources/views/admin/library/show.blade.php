@extends('layouts.admin')

@section('title', 'Detalhes do Arquivo - Biblioteca')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Detalhes do Arquivo</h1>
                <div class="flex gap-2">
                    <a href="{{ route('admin.library.edit', $file) }}"
                       class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 transition">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                    <a href="{{ route('admin.library.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                    @if($file->cover_path)
                        <img src="{{ route('admin.library.cover', $file) }}" alt="{{ $file->title }}" class="max-h-56 rounded-lg object-cover">
                    @else
                        <i class="fas {{ $file->isImage() ? 'fa-image text-amber-600' : 'fa-file-pdf text-green-700' }} text-6xl my-8"></i>
                    @endif
                    <a href="{{ route('admin.library.download', $file) }}"
                       class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-green-700 text-white text-sm font-semibold rounded-lg hover:bg-green-800 transition">
                        <i class="fas fa-download mr-2"></i>
                        Baixar Arquivo ({{ $file->formattedSize() }})
                    </a>
                </div>

                <div class="md:col-span-2 space-y-4">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Título</span>
                        <h2 class="text-xl font-bold text-gray-900">{{ $file->title }}</h2>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Tags</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($file->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if($file->description)
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Descrição</span>
                            <p class="text-sm text-gray-700 whitespace-pre-line">{{ $file->description }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100 text-sm">
                        <div>
                            <span class="text-gray-400 block text-xs">Nome Original</span>
                            <span class="font-medium text-gray-800">{{ $file->original_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">MIME Type</span>
                            <span class="font-medium text-gray-800">{{ $file->mime_type }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">Enviado por</span>
                            <span class="font-medium text-gray-800">{{ $file->uploader?->name ?? 'Sistema' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">Data de Envio</span>
                            <span class="font-medium text-gray-800">{{ $file->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
