<section id="sobre" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Section Title -->
        <x-ui.section-title
            title="Sobre Nossa Casa"
            subtitle="Conheça nossa história, missão e os Orixás que guiam nosso caminho"
        />

        <!-- Cards Grid -->
        <div
            x-data="{
                cards: [
                    { show: false, delay: 0 },
                    { show: false, delay: 200 },
                    { show: false, delay: 400 }
                ]
            }"
            x-init="cards.forEach((card, i) => {
                setTimeout(() => card.show = true, card.delay);
            })"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12"
        >

            <!-- Card 1: História -->
            <div
                x-show="cards[0].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    icon="book"
                    title="Nossa História"
                    text="A Casa de Caridade Legião de Oxóssi e Ogum foi fundada com o propósito de oferecer um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico. Ao longo dos anos, temos servido à comunidade com dedicação e amor."
                />
            </div>

            <!-- Card 2: Missão -->
            <div
                x-show="cards[1].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    icon="heart"
                    title="Missão e Valores"
                    text="Nossa missão é promover a caridade, o amor ao próximo e o desenvolvimento espiritual através dos ensinamentos da Umbanda. Trabalhamos com fé, humildade e respeito às forças da natureza e aos Orixás."
                />
            </div>

            <!-- Card 3: Orixás -->
            <div
                x-show="cards[2].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    icon="star"
                    title="Oxóssi e Ogum"
                    text="Oxóssi, o caçador das matas, representa fartura e conhecimento. Ogum, o guerreiro, simboliza força e determinação. São nossos guias espirituais que nos auxiliam no caminho da evolução e da caridade."
                />
            </div>

        </div>
    </div>
</section>
