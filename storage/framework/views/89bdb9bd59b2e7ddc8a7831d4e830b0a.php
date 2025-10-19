<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-800">Amacis</h2>
    <form wire:submit="save" class="space-y-6">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            <?php echo e(session('message')); ?>

        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                <input type="text" id="type" wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" id="date" wire:model="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="md:col-span-2">
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea id="observations" wire:model="observations" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['observations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <!--[if BLOCK]><![endif]--><?php if($editingId): ?>
            <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Cancelar
            </button>
            <?php else: ?>
            <div></div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <?php echo e($editingId ? 'Atualizar' : 'Adicionar'); ?> Amaci
            </button>
        </div>
    </form>

    <!--[if BLOCK]><![endif]--><?php if(count($amacis) > 0): ?>
    <div class="mt-8">
        <h3 class="text-md font-medium text-gray-700 mb-4">Amacis Registrados</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observações</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $amacis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amaci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($amaci->type); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($amaci->date?->format('d/m/Y')); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo e(Str::limit($amaci->observations, 30)); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit(<?php echo e($amaci->id); ?>)" class="text-indigo-600 hover:text-indigo-900 mr-2">Editar</button>
                            <button wire:click="delete(<?php echo e($amaci->id); ?>)" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/livewire/amaci-form.blade.php ENDPATH**/ ?>