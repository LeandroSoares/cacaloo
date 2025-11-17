# Script para normalizar formulários Livewire

$forms = @(
    @{file="initiated-mystery-form.blade.php"; title="Mistérios Iniciados"; icon="🌙"},
    @{file="initiated-orisha-form.blade.php"; title="Orixás Iniciados"; icon="⭐"},
    @{file="priestly-formation-form.blade.php"; title="Formação Sacerdotal"; icon="📿"},
    @{file="work-guide-form.blade.php"; title="Guias de Trabalho"; icon="🕯️"},
    @{file="entity-consecration-form.blade.php"; title="Consagrações"; icon="💫"},
    @{file="religious-course-form.blade.php"; title="Cursos Religiosos de Umbanda"; icon="📚"},
    @{file="last-temple-form.blade.php"; title="Último Templo"; icon="🏛️"}
)

foreach ($form in $forms) {
    $file = "resources\views\livewire\$($form.file)"
    Write-Host "Processando $file..."

    if (Test-Path $file) {
        $content = Get-Content $file -Raw

        # Substituir abertura div + título
        $content = $content -replace '<div class="(bg-white overflow-hidden shadow-sm sm:rounded-lg|p-6 bg-white rounded-lg shadow-md( mb-8)?) p-6">\s*<h2 class="text-[xl|lg]+ font-semibold text-gray-8(0|00) mb-4">.*?</h2>', "<x-form-card title=`"$($form.title)`" icon=`"$($form.icon)`">"

        # Substituir fechamento div
        $content = $content -replace '</div>\s*$', '</x-form-card>'

        # Substituir mensagens de sucesso simples
        $content = $content -replace '<div class="(p-4 mb-4 text-sm text-green-7(0|00) bg-green-1(0|00) rounded-lg|mb-4 p-4 bg-green-100 text-green-700 rounded)">\s*\{\{ session\(''message''\) \}\}\s*</div>', '<x-alert type="success">{{ session(''message'') }}</x-alert>'

        # Substituir mensagens de erro
        $content = $content -replace '<div class="p-4 mb-4 text-sm text-red-7(0|00) bg-red-1(0|00) rounded-lg">', '<x-alert type="error">'
        $content = $content -replace '</ul>\s*</div>\s*@endif', '</ul></x-alert>@endif'

        # Substituir botões submit azuis
        $content = $content -replace '<button type="submit" class="(bg-blue-600 hover:bg-blue-700|px-4 py-2 bg-blue-600|inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md).*?">', '<x-button type="submit">'
        $content = $content -replace '</button>\s*</div>\s*</form>', '</x-button></div></form>'

        # Substituir botões cancel/secondary
        $content = $content -replace '<button type="button".*?wire:click="cancel" class="(bg-gray-500 hover:bg-gray-600|px-4 py-2 bg-gray-300|inline-flex.*?border-gray-300).*?">', '<x-button type="button" wire:click="cancel" variant="secondary">'

        Set-Content $file -Value $content -NoNewline
        Write-Host "✓ $file normalizado"
    }
}

Write-Host "`nNormalização concluída!"
