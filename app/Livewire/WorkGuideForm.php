<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WorkGuideCategory;
use Livewire\Component;

class WorkGuideForm extends Component
{
    public User $user;

    // Array dinâmico para armazenar valores das categorias
    public array $values = [];

    public function mount(User $user)
    {
        $this->user = $user;

        // Carregar valores existentes de work_guide_user_values
        foreach ($user->workGuideValues as $userValue) {
            $this->values[$userValue->category_id] = $userValue->value;
        }

        // Retrocompatibilidade: migrar dados da tabela antiga se existirem e não houver valores novos
        if (count($this->values) === 0 && $user->workGuide) {
            $this->migrateOldData();
        }
    }

    /**
     * Migra dados da estrutura antiga para a nova (retrocompatibilidade temporária)
     */
    private function migrateOldData()
    {
        $oldGuide = $this->user->workGuide;
        $categories = WorkGuideCategory::active()->get();

        foreach ($categories as $category) {
            if (isset($oldGuide->{$category->slug})) {
                $this->values[$category->id] = $oldGuide->{$category->slug};
            }
        }
    }

    public function save()
    {
        // Validação dinâmica
        $this->validate([
            'values' => 'array',
            'values.*' => 'nullable|string|max:255',
        ]);

        // Sincronizar valores com a base de dados
        foreach ($this->values as $categoryId => $value) {
            if (!empty($value)) {
                $this->user->workGuideValues()->updateOrCreate(
                    ['category_id' => $categoryId],
                    ['value' => $value]
                );
            } else {
                // Remover se valor estiver vazio
                $this->user->workGuideValues()
                    ->where('category_id', $categoryId)
                    ->delete();
            }
        }

        session()->flash('message', 'Guias de trabalho salvos com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        // Carregar categorias ativas ordenadas
        $categories = WorkGuideCategory::active()
            ->ordered()
            ->get();

        return view('livewire.work-guide-form', [
            'categories' => $categories,
        ]);
    }
}
