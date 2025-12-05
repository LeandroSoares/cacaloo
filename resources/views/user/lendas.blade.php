@extends('layouts.user')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                    Lendas de Umbanda
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Histórias ancestrais que revelam a sabedoria, os mistérios e a essência dos Orixás.
                    Mergulhe no conhecimento sagrado transmitido através das gerações.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="h-1 w-24 bg-indigo-600 rounded-full"></div>
                </div>
            </div>

            <!-- Legends Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Lenda de Oxalá -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                    <div class="bg-indigo-600 h-3"></div>
                    <div class="p-8">
                        <div
                            class="flex items-center justify-center w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full mb-6 mx-auto">
                            <i class="fa-solid fa-cloud-sun text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">A Criação do Mundo</h3>
                        <p class="text-sm text-indigo-600 font-semibold text-center mb-6 uppercase tracking-wide">Oxalá e a
                            Humildade</p>
                        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                            <p>
                                Conta a lenda que Olorum confiou a Oxalá a grande missão de criar o mundo. Entregou-lhe o
                                "Saco da Criação" com todo o axé necessário. Oxalá, sentindo-se poderoso e confiante, partiu
                                para sua jornada.
                            </p>
                            <p>
                                No caminho, encontrou Exu, que esperava pelas oferendas tradicionais de início de jornada.
                                Orgulhoso de sua missão divina, Oxalá julgou desnecessário reverenciar o mensageiro. Exu,
                                então, fez com que uma sede insuportável acometesse o Grande Orixá.
                            </p>
                            <p>
                                Sedento, Oxalá furou um dendezeiro para beber sua seiva. O vinho de palma o embriagou, e ele
                                adormeceu profundamente. Oduduwa, vendo a oportunidade, tomou o Saco da Criação e cumpriu a
                                missão de criar a Terra. Ao acordar, Oxalá aprendeu a lição eterna: nem mesmo o maior dos
                                Orixás está acima da humildade e do respeito aos outros.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Lenda de Oxum -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                    <div class="bg-yellow-500 h-3"></div>
                    <div class="p-8">
                        <div
                            class="flex items-center justify-center w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full mb-6 mx-auto">
                            <i class="fa-solid fa-heart text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">O Amor Verdadeiro</h3>
                        <p class="text-sm text-yellow-600 font-semibold text-center mb-6 uppercase tracking-wide">Oxum e o
                            Poeta</p>
                        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                            <p>
                                Oxum, a bela deusa das águas doces, era cortejada por todos. Grandes guerreiros e reis
                                poderosos ofereciam-lhe riquezas, palácios e exércitos. Mas o coração de Oxum não se deixava
                                comprar por ouro ou poder.
                            </p>
                            <p>
                                Um dia, um pobre andarilho chegou à aldeia. Sem nada a oferecer além de sua voz, ele começou
                                a recitar poesias que descreviam a beleza das cachoeiras e a doçura do mel. Suas palavras
                                tocaram a alma de Oxum como nenhuma joia jamais fizera.
                            </p>
                            <p>
                                Oxum escolheu o andarilho, revelando que o verdadeiro amor reside na sensibilidade e na
                                conexão de almas, não nas posses materiais. Dizem que o andarilho era Xangô, que se despiu
                                de sua realeza para conquistar o amor de Oxum apenas por quem ele era de verdade.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Lenda de Ogum -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                    <div class="bg-red-600 h-3"></div>
                    <div class="p-8">
                        <div
                            class="flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-full mb-6 mx-auto">
                            <i class="fa-solid fa-hammer text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">O Segredo do Ferro</h3>
                        <p class="text-sm text-red-600 font-semibold text-center mb-6 uppercase tracking-wide">Ogum e a
                            Evolução</p>
                        <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                            <p>
                                Nos tempos antigos, os Orixás vinham à Terra, mas tinham dificuldade em limpar os terrenos
                                para o plantio e a construção, pois suas ferramentas eram de madeira e pedra, frágeis e
                                ineficientes.
                            </p>
                            <p>
                                Ogum, o ferreiro divino, desceu do Orun trazendo o segredo do ferro. Com fogo e força,
                                forjou o facão, a enxada e a lança. Ele ensinou aos homens a arte da forja, permitindo que a
                                humanidade cultivasse a terra com eficácia e se defendesse dos perigos.
                            </p>
                            <p>
                                Os outros Orixás, admirados, deram a Ogum o título de Senhor dos Caminhos. A lenda nos
                                ensina que Ogum é aquele que abre as estradas do progresso e que a tecnologia e o trabalho
                                árduo são as chaves para a evolução da humanidade.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Quote -->
            <div class="mt-16 text-center">
                <blockquote class="text-xl italic text-gray-500 font-serif">
                    "As lendas não são apenas histórias do passado, são espelhos onde vemos nossa própria alma e o caminho
                    para o divino."
                </blockquote>
            </div>

        </div>
    </div>
@endsection