<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-4">Área do Usuário</h1>
                <p>Bem-vindo à sua área pessoal, <?php echo e(Auth::user()->name); ?>!</p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-blue-50 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold text-blue-700">Perfil</h2>
                        <p class="mt-2 text-gray-600">Gerencie suas informações pessoais e preferências.</p>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Editar perfil →</a>
                    </div>

                    <!-- Adicione mais cards conforme necessário -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/user/dashboard.blade.php ENDPATH**/ ?>