<?php $__env->startSection('title', 'Dashboard SysAdmin'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="bg-purple-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-white">
            <h1 class="text-2xl font-semibold mb-6 border-b border-purple-700 pb-2">Painel de Sistema</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card Permissões -->
                <div class="bg-purple-800 p-6 rounded-lg border border-purple-600 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-purple-200">Permissões</h2>
                        <svg class="w-8 h-8 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-purple-200 opacity-80">Gerencie as permissões do sistema.</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="<?php echo e(route('sysadmin.permissions.index')); ?>" class="text-purple-300 hover:text-white">Ver todas →</a>
                    </div>
                </div>

                <!-- Card Logs do Sistema -->
                <div class="bg-purple-800 p-6 rounded-lg border border-purple-600 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-purple-200">Logs do Sistema</h2>
                        <svg class="w-8 h-8 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-purple-200 opacity-80">Monitore os logs de atividade do sistema.</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="<?php echo e(route('sysadmin.system.logs')); ?>" class="text-purple-300 hover:text-white">Ver logs →</a>
                    </div>
                </div>

                <!-- Estatísticas do Sistema -->
                <div class="bg-purple-800 p-6 rounded-lg border border-purple-600 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-purple-200">Estatísticas</h2>
                        <svg class="w-8 h-8 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-purple-200 opacity-80">Visualize estatísticas gerais do sistema.</p>
                    <div class="mt-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-purple-200">Uso de CPU</span>
                            <span class="text-purple-200">62%</span>
                        </div>
                        <div class="w-full bg-purple-700 rounded-full h-2">
                            <div class="bg-purple-300 h-2 rounded-full" style="width: 62%"></div>
                        </div>

                        <div class="flex justify-between mb-1 mt-3">
                            <span class="text-purple-200">Uso de Memória</span>
                            <span class="text-purple-200">45%</span>
                        </div>
                        <div class="w-full bg-purple-700 rounded-full h-2">
                            <div class="bg-purple-400 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sysadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/sysadmin/dashboard.blade.php ENDPATH**/ ?>