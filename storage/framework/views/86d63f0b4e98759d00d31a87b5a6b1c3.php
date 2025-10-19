<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Casa de Caridade Legião de Oxóssi e Ogum')); ?></title>

        <!-- Preconnect para fontes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-body text-gray-900 antialiased">
        <!-- Background com Floresta -->
        <div class="min-h-screen relative overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img
                    src="<?php echo e(asset('images/floresta2.jpg')); ?>"
                    alt=""
                    role="presentation"
                    class="w-full h-full object-cover object-center"
                >
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-oxossi/40 via-black/60 to-ogum/40"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 min-h-screen flex flex-col justify-center items-center py-8 sm:py-12 px-4">
                <!-- Logo -->
                <div class="mb-6 sm:mb-8 mt-4 sm:mt-0">
                    <a href="<?php echo e(route('home')); ?>" class="flex flex-col items-center space-y-3 sm:space-y-4">
                        <img
                            src="<?php echo e(asset('images/logo600x600.png')); ?>"
                            alt="Logo Casa de Caridade Legião de Oxóssi e Ogum"
                            class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 rounded-full ring-4 ring-gold shadow-2xl"
                        >
                        <h1 class="text-white text-base sm:text-xl lg:text-2xl font-bold font-sans text-center drop-shadow-lg leading-tight">
                            Casa de Caridade<br>
                            <span class="text-gold">Legião de Oxóssi e Ogum</span>
                        </h1>
                    </a>
                </div>

                <!-- Form Container -->
                <div class="w-full sm:max-w-md bg-white/95 backdrop-blur-sm shadow-strong overflow-hidden rounded-xl border border-white/20">
                    <div class="px-6 py-6 sm:px-8 sm:py-8">
                        <?php echo e($slot); ?>

                    </div>
                </div>

                <!-- Voltar para Home -->
                <div class="mt-6">
                    <a href="<?php echo e(route('home')); ?>" class="text-white/80 hover:text-white font-medium transition-colors duration-300 text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Voltar para o site</span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/layouts/guest.blade.php ENDPATH**/ ?>