<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Cursos Religiosos de Umbanda</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Lista de cursos já cadastrados -->
    @if (count($religiousCourses) > 0)
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Cursos Registrados</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CURSO</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATA</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">INICIAÇÃO</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OBSERVAÇÕES</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <span class="flex items-center">
                                    AÇÕES
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($religiousCourses as $index => $course)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $course['course']['name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($course['date'])->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($course['finished'])
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Finalizado</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Em Andamento</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($course['has_initiation'])
                                            <div>✓ Sim</div>
                                            @if($course['initiation_date'])
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($course['initiation_date'])->format('d/m/Y') }}</div>
                                            @endif
                                        @else
                                            <span class="text-gray-400">Não</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">
                                        {{ $course['observations'] ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $course['id'] }})"
                                                class="text-blue-600 hover:text-blue-900">
                                            Editar
                                        </button>
                                        <button wire:click="delete({{ $course['id'] }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Tem certeza que deseja remover este curso?')">
                                            Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mb-6 p-4 bg-gray-50 rounded text-gray-500">
            Nenhum curso religioso cadastrado até o momento.
        </div>
    @endif

    <!-- Formulário para adicionar/editar curso -->
    <div class="border-t pt-6">
        <form wire:submit.prevent="save" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome do Curso -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700">Nome do Curso</label>
                    <select wire:model="newCourse.course_id" id="course_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Selecione um curso</option>
                        @foreach($availableCourses as $course)
                            <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                        @endforeach
                    </select>
                    @error('newCourse.course_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Data do Curso -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Data do Curso</label>
                    <input type="date" wire:model="newCourse.date" id="date"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('newCourse.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Possui Iniciação -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input wire:model="newCourse.has_initiation" id="has_initiation" type="checkbox"
                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="has_initiation" class="font-medium text-gray-700">Possui Iniciação</label>
                    </div>
                </div>

                <!-- Data da Iniciação -->
                <div>
                    <label for="initiation_date" class="block text-sm font-medium text-gray-700">Data da Iniciação</label>
                    <input type="date" wire:model="newCourse.initiation_date" id="initiation_date"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                           @if(!$newCourse['has_initiation']) disabled @endif>
                    @error('newCourse.initiation_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Curso Finalizado -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input wire:model="newCourse.finished" id="finished" type="checkbox"
                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="finished" class="font-medium text-gray-700">Curso Finalizado</label>
                    </div>
                </div>
            </div>

            <!-- Observações -->
            <div>
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea wire:model="newCourse.observations" id="observations" rows="3"
                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          placeholder="Digite suas observações sobre o curso..."></textarea>
                @error('newCourse.observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Botões -->
            <div class="pt-4 flex space-x-3">
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    @if($isEditing)
                        Atualizar Curso
                    @else
                        Adicionar Curso
                    @endif
                </button>

                @if($isEditing)
                    <button type="button" wire:click="cancel"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </button>
                @endif
            </div>
        </form>
    </div>

    <script>
        // Habilita/desabilita o campo de data da iniciação baseado no checkbox
        document.addEventListener('livewire:update', function () {
            const hasInitiationCheckbox = document.getElementById('has_initiation');
            const initiationDateField = document.getElementById('initiation_date');

            if (hasInitiationCheckbox && initiationDateField) {
                function toggleInitiationDate() {
                    initiationDateField.disabled = !hasInitiationCheckbox.checked;
                    if (!hasInitiationCheckbox.checked) {
                        initiationDateField.value = '';
                    }
                }

                hasInitiationCheckbox.addEventListener('change', toggleInitiationDate);
                toggleInitiationDate(); // Executar na inicialização
            }
        });
    </script>
</div>
