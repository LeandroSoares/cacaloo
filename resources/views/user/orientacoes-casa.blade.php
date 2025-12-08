@extends('layouts.user')

@section('content')
    <div class="py-12">
<div class="py-12 max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-8">Orientações da Casa</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Card 1 – Mandamentos da Casa -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Mandamentos da Casa e do Médium</h2>
            <p class="text-gray-600 mb-4">
                Conjunto de responsabilidades e princípios que orientam o médium dentro da casa espiritual,
                enfatizando respeito, comprometimento, humildade e conduta exemplar.
            </p>
            <button onclick="document.getElementById('modal1').showModal()" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ler Mais
            </button>
        </div>

        <!-- Card 2 – Conduta do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Conduta do Médium</h2>
            <p class="text-gray-600 mb-4">
                Diretrizes para que o médium mantenha equilíbrio emocional, disciplina espiritual,
                respeito às entidades e postura adequada dentro e fora do templo.
            </p>
            <button onclick="document.getElementById('modal2').showModal()" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Ler Mais
            </button>
        </div>

        <!-- Card 3 – Disciplina do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Disciplina do Médium</h2>
            <p class="text-gray-600 mb-4">
                Conteúdo que explica as obrigações espirituais, horários, respeito às hierarquias
                e importância da disciplina para o desenvolvimento mediúnico.
            </p>
            <button onclick="document.getElementById('modal3').showModal()" 
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Ler Mais
            </button>
        </div>

        <!-- Card 4 – Preparação do Médium -->
        <div class="bg-white shadow-lg rounded-xl p-6 border">
            <h2 class="text-xl font-bold mb-3">Preparação do Médium antes dos Trabalhos</h2>
            <p class="text-gray-600 mb-4">
                Recomendações sobre banho de descarrego, alimentação, limpeza energética,
                mentalização e cuidados essenciais antes dos trabalhos espirituais.
            </p>
            <button onclick="document.getElementById('modal4').showModal()" 
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Ler Mais
            </button>
        </div>

    </div>
</div>

<!-- MODAIS (Conteúdo Completo) -->

<!-- Modal 1 -->
<dialog id="modal1" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Mandamentos da Casa e do Médium</h2>
        <p class="text-gray-700 leading-relaxed">
            <!-- CONTEÚDO REAL DO ARQUIVO AQUI -->
            Posso inserir o conteúdo completo do arquivo 2.17 — basta pedir!
        </p>
        <button onclick="document.getElementById('modal1').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>
    </div>
</dialog>

<!-- Modal 2 -->
<dialog id="modal2" class="p-0 rounded-xl w-11/12 md:w-2/3">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Conduta do Médium</h2>
        <p class="text-gray-700 leading-relaxed">
            <!-- CONTEÚDO REAL DO ARQUIVO AQUI -->
            Posso inserir o conteúdo completo do arquivo 2.18 — basta pedir!
        </p>
        <button onclick="document.getElementById('modal2').close()" 
                class="mt-6 bg-gray-700 text-white px-4 py-2 rounded-lg">
            Fechar
        </button>

@endsection
