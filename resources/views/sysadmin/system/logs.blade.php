@extends('layouts.sysadmin')

@section('title', 'Logs do Sistema')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-4">Logs do Sistema</h2>

                <div class="mb-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium">Arquivo de Log Atual</h3>
                            <p class="text-gray-600 text-sm">{{ date('d/m/Y H:i:s') }}</p>
                        </div>
                        <div>
                            <a href="{{ route('sysadmin.system.logs') }}?download=1" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Baixar Log
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto bg-gray-100 p-4 rounded-md">
                    <pre class="text-sm whitespace-pre-wrap font-mono text-gray-800" style="max-height: 500px; overflow-y: auto;">
@php
    // Lê os últimos 200 KB do arquivo de log para não sobrecarregar a página
    $logPath = storage_path('logs/laravel.log');
    $logContent = "Nenhum log encontrado.";

    if (file_exists($logPath)) {
        $size = filesize($logPath);
        $maxSize = 200 * 1024; // 200 KB

        if ($size > $maxSize) {
            $fp = fopen($logPath, 'r');
            fseek($fp, $size - $maxSize);
            $logContent = fread($fp, $maxSize);
            fclose($fp);
            $logContent = "... (mostrando apenas os últimos 200 KB) ...\n\n" . $logContent;
        } else {
            $logContent = file_get_contents($logPath);
        }
    }

    echo htmlspecialchars($logContent);
@endphp
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
