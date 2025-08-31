<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Cursos Religiosos</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Lista de cursos já cadastrados -->
    @if (count($religiousCourses) > 0)
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Cursos Realizados</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instituição</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificado</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
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
                                    <div class="text-sm text-gray-900">{{ $course['institution'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($course['start_date'])->format('d/m/Y') }}
                                        @if($course['end_date'])
                                            até {{ \Carbon\Carbon::parse($course['end_date'])->format('d/m/Y') }}
                                        @else
                                            (em andamento)
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($course['certificate'])
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sim</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Não</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="deleteCourse({{ $course['id'] }})"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Tem certeza que deseja remover este curso?')">
                                        Remover
                                    </button>
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

    <!-- Formulário para adicionar novo curso -->
    <h3 class="text-lg font-medium text-gray-700 mb-2">Adicionar Novo Curso</h3>
    <form wire:submit.prevent="addCourse" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="course_id" class="block text-sm font-medium text-gray-700">Curso</label>
                <select wire:model="newCourse.course_id" id="course_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Selecione um curso</option>
                    @foreach($availableCourses as $course)
                        <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                    @endforeach
                </select>
                @error('newCourse.course_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="institution" class="block text-sm font-medium text-gray-700">Instituição</label>
                <input type="text" wire:model="newCourse.institution" id="institution" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newCourse.institution') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                <input type="date" wire:model="newCourse.start_date" id="start_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newCourse.start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Conclusão</label>
                <input type="date" wire:model="newCourse.end_date" id="end_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <div class="text-xs text-gray-500 mt-1">Deixe em branco se o curso ainda estiver em andamento</div>
                @error('newCourse.end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input wire:model="newCourse.certificate" id="certificate" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="certificate" class="font-medium text-gray-700">Possui Certificado</label>
                </div>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Adicionar Curso
            </button>
        </div>
    </form>
</div>
