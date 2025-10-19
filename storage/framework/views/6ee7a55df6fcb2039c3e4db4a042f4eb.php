<div class="bg-white rounded-lg shadow p-6 mb-8 border border-gray-200">
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Dados Pessoais</h3>
    <form wire:submit.prevent="save" class="space-y-4">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e(__($error)); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </ul>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                <input type="text" id="name" wire:model.defer="name" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-600 mb-1">Endereço</label>
                <input type="text" id="address" wire:model.defer="address" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="zip_code" class="block text-sm font-medium text-gray-600 mb-1">CEP</label>
                <input type="text" id="zip_code" wire:model.defer="zip_code" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" id="email" wire:model.defer="email" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-600 mb-1">CPF</label>
                <input type="text" id="cpf" wire:model.defer="cpf" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="rg" class="block text-sm font-medium text-gray-600 mb-1">RG</label>
                <input type="text" id="rg" wire:model.defer="rg" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-600 mb-1">Data de Nascimento</label>
                <input type="date" id="birth_date" wire:model.defer="birth_date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="home_phone" class="block text-sm font-medium text-gray-600 mb-1">Telefone Fixo</label>
                <input type="text" id="home_phone" wire:model.defer="home_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="mobile_phone" class="block text-sm font-medium text-gray-600 mb-1">Celular</label>
                <input type="text" id="mobile_phone" wire:model.defer="mobile_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="work_phone" class="block text-sm font-medium text-gray-600 mb-1">Telefone Trabalho</label>
                <input type="text" id="work_phone" wire:model.defer="work_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div class="col-span-2">
                <label for="emergency_contact" class="block text-sm font-medium text-gray-600 mb-1">Contato de Emergência</label>
                <input type="text" id="emergency_contact" wire:model.defer="emergency_contact" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">Salvar Dados</button>
        </div>
    </form>
</div>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/livewire/personal-data-form.blade.php ENDPATH**/ ?>