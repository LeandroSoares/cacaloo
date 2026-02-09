@extends('layouts.user')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-16">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Histórico Mediúnico</h1>

            <!-- Barra de Progresso -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 mb-2">Progresso do Preenchimento</h2>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                </div>
                <p class="text-sm text-gray-600 mt-2">{{ round($progressPercentage) }}% completo</p>
            </div>

            <!-- Dados Pessoais -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Dados Pessoais</h2>
                @if($user->personalData)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome</p>
                            <p class="text-base">{{ $user->personalData->name ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-base">{{ $user->personalData->email ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Endereço</p>
                            <p class="text-base">{{ $user->personalData->address ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">CEP</p>
                            <p class="text-base">{{ $user->personalData->zip_code ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">CPF</p>
                            <p class="text-base">{{ $user->personalData->cpf ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">RG</p>
                            <p class="text-base">{{ $user->personalData->rg ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data de Nascimento</p>
                            <p class="text-base">{{ $user->personalData->birth_date ? $user->personalData->birth_date->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Telefone Celular</p>
                            <p class="text-base">{{ $user->personalData->mobile_phone ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação pessoal cadastrada</p>
                @endif
            </div>

            <!-- Informações Religiosas -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Informações Religiosas</h2>
                @if($user->religiousInfo)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data de Início</p>
                            <p class="text-base">{{ $user->religiousInfo->start_date ? $user->religiousInfo->start_date->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Local de Início</p>
                            <p class="text-base">{{ $user->religiousInfo->start_location ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Início na Casa de Caridade</p>
                            <p class="text-base">{{ $user->religiousInfo->charity_house_start ? $user->religiousInfo->charity_house_start->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Batismo na Umbanda</p>
                            <p class="text-base">{{ $user->religiousInfo->umbanda_baptism ? $user->religiousInfo->umbanda_baptism->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação religiosa cadastrada</p>
                @endif
            </div>

            <!-- Formação Sacerdotal -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Formação Sacerdotal</h2>
                @if($user->priestlyFormation)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Início da Teologia</p>
                            <p class="text-base">{{ $user->priestlyFormation->theology_start ? $user->priestlyFormation->theology_start->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Conclusão da Teologia</p>
                            <p class="text-base">{{ $user->priestlyFormation->theology_end ? $user->priestlyFormation->theology_end->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Início do Sacerdócio</p>
                            <p class="text-base">{{ $user->priestlyFormation->priesthood_start ? $user->priestlyFormation->priesthood_start->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Conclusão do Sacerdócio</p>
                            <p class="text-base">{{ $user->priestlyFormation->priesthood_end ? $user->priestlyFormation->priesthood_end->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre formação sacerdotal cadastrada</p>
                @endif
            </div>

            <!-- Coroações -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Coroações</h2>
                @if($user->crowning)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data de Início</p>
                            <p class="text-base">{{ $user->crowning->start_date ? $user->crowning->start_date->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data de Conclusão</p>
                            <p class="text-base">{{ $user->crowning->end_date ? $user->crowning->end_date->format('d/m/Y') : 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome do Guia</p>
                            <p class="text-base">{{ $user->crowning->guide_name ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome do Sacerdote</p>
                            <p class="text-base">{{ $user->crowning->priest_name ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome do Templo</p>
                            <p class="text-base">{{ $user->crowning->temple_name ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre coroações cadastrada</p>
                @endif
            </div>

            <!-- Orixás de Cabeça -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Orixás de Cabeça</h2>
                @if($user->headOrisha)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Ancestral</p>
                            <p class="text-base">{{ $user->headOrisha->ancestor ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Frente</p>
                            <p class="text-base">{{ $user->headOrisha->front ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Frente (Junto)</p>
                            <p class="text-base">{{ $user->headOrisha->front_together ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Adjunto</p>
                            <p class="text-base">{{ $user->headOrisha->adjunct ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Adjunto (Junto)</p>
                            <p class="text-base">{{ $user->headOrisha->adjunct_together ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lado Esquerdo</p>
                            <p class="text-base">{{ $user->headOrisha->left_side ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lado Esquerdo (Junto)</p>
                            <p class="text-base">{{ $user->headOrisha->left_side_together ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lado Direito</p>
                            <p class="text-base">{{ $user->headOrisha->right_side ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lado Direito (Junto)</p>
                            <p class="text-base">{{ $user->headOrisha->right_side_together ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre orixás de cabeça cadastrada</p>
                @endif
            </div>

            <!-- Cruz de Força -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Cruz de Força</h2>
                @if($user->forceCross)
                    <div class="grid grid-cols-2 gap-4 max-w-md mx-auto">
                        <div class="col-span-2 text-center">
                            <p class="text-sm font-medium text-gray-500">Cima</p>
                            <p class="text-base">{{ $user->forceCross->top ?? 'Não informado' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-medium text-gray-500">Esquerda</p>
                            <p class="text-base">{{ $user->forceCross->left ?? 'Não informado' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-medium text-gray-500">Direita</p>
                            <p class="text-base">{{ $user->forceCross->right ?? 'Não informado' }}</p>
                        </div>
                        <div class="col-span-2 text-center">
                            <p class="text-sm font-medium text-gray-500">Baixo</p>
                            <p class="text-base">{{ $user->forceCross->bottom ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre cruz de força cadastrada</p>
                @endif
            </div>

            <!-- Cruzamentos -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Cruzamentos</h2>
                @if($user->crossings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entidade</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propósito</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->crossings as $crossing)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $crossing->entity ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $crossing->date ? $crossing->date->format('d/m/Y') : 'Não informado' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $crossing->purpose ?? 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum cruzamento cadastrado</p>
                @endif
            </div>

            <!-- Guias de Trabalho -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Guias de Trabalho</h2>
                @if($user->workGuide)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Caboclo</p>
                            <p class="text-base">{{ $user->workGuide->caboclo ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cabocla</p>
                            <p class="text-base">{{ $user->workGuide->cabocla ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Ogum</p>
                            <p class="text-base">{{ $user->workGuide->ogum ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Xangô</p>
                            <p class="text-base">{{ $user->workGuide->xango ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Baiano</p>
                            <p class="text-base">{{ $user->workGuide->baiano ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Baiana</p>
                            <p class="text-base">{{ $user->workGuide->baiana ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Preto Velho</p>
                            <p class="text-base">{{ $user->workGuide->preto_velho ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Preta Velha</p>
                            <p class="text-base">{{ $user->workGuide->preta_velha ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Marinheiro</p>
                            <p class="text-base">{{ $user->workGuide->marinheiro ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Erê</p>
                            <p class="text-base">{{ $user->workGuide->ere ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Exu</p>
                            <p class="text-base">{{ $user->workGuide->exu ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pombagira</p>
                            <p class="text-base">{{ $user->workGuide->pombagira ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Exu Mirim</p>
                            <p class="text-base">{{ $user->workGuide->exu_mirim ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre guias de trabalho cadastrada</p>
                @endif
            </div>

            <!-- Amacis -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Amacis</h2>
                @if($user->amacis->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->amacis as $amaci)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $amaci->type ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $amaci->date ? $amaci->date->format('d/m/Y') : 'Não informado' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $amaci->observations ?? 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum amaci cadastrado</p>
                @endif
            </div>

            <!-- Consagrações de Entidades -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Consagrações de Entidades</h2>
                @if($user->entityConsecrations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entidade</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->entityConsecrations as $consecration)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $consecration->entity ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $consecration->name ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $consecration->date ? $consecration->date->format('d/m/Y') : 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma consagração de entidade cadastrada</p>
                @endif
            </div>

            <!-- Último Templo -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Último Templo</h2>
                @if($user->lastTemple)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome</p>
                            <p class="text-base">{{ $user->lastTemple->name ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Endereço</p>
                            <p class="text-base">{{ $user->lastTemple->address ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome do Líder</p>
                            <p class="text-base">{{ $user->lastTemple->leader_name ?? 'Não informado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Função</p>
                            <p class="text-base">{{ $user->lastTemple->function ?? 'Não informado' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-gray-500">Motivo da Saída</p>
                            <p class="text-base">{{ $user->lastTemple->exit_reason ?? 'Não informado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma informação sobre último templo cadastrada</p>
                @endif
            </div>

            <!-- Curso Religiosos -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Cursos Religiosos</h2>
                @if($user->religiousCourses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instituição</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->religiousCourses as $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $course->course->name ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $course->institution ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $course->date ? $course->date->format('d/m/Y') : 'Não informado' }}
                                        @if(!$course->finished)
                                            (em andamento)
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum curso religioso cadastrado</p>
                @endif
            </div>

            <!-- Mistérios Iniciados -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Mistérios Iniciados</h2>
                @if($user->initiatedMysteries->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mistério</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Templo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sacerdote</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->initiatedMysteries as $mystery)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mystery->mystery->name ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mystery->date ? $mystery->date->format('d/m/Y') : 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mystery->temple ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mystery->priest_name ?? 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum mistério iniciado cadastrado</p>
                @endif
            </div>

            <!-- Orixás Iniciados -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Orixás Iniciados</h2>
                @if($user->initiatedOrishas->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orixá</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Templo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sacerdote</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->initiatedOrishas as $orisha)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orisha->orisha->name ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orisha->date ? $orisha->date->format('d/m/Y') : 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orisha->temple ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orisha->priest_name ?? 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum orixá iniciado cadastrado</p>
                @endif
            </div>

            <!-- Magias Divinas -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Magias Divinas</h2>
                @if($user->divineMagics->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Magia</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Templo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sacerdote</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->divineMagics as $magic)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $magic->magicType->name ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $magic->date ? $magic->date->format('d/m/Y') : 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $magic->temple ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $magic->priest_name ?? 'Não informado' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhuma magia divina cadastrada</p>
                @endif
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('user.meus-dados') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Editar Dados
                </a>
                <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Imprimir Histórico
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
