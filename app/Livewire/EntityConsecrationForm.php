<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\EntityConsecration;

class EntityConsecrationForm extends Component
{
    public User $user;
    public $consecrations = [];
    public $entity = null;
    public $name = null;
    public $date = null;
    public $editingId = null;

    protected $rules = [
        'entity' => 'nullable|string|max:255',
        'name' => 'nullable|string|max:255',
        'date' => 'nullable|date',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadConsecrations();
    }

    public function loadConsecrations()
    {
        $this->consecrations = $this->user->entityConsecrations()->orderBy('date', 'desc')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $consecration = EntityConsecration::find($this->editingId);
            if ($consecration && $consecration->user_id == $this->user->id) {
                $consecration->update([
                    'consecration_date' => $this->consecration_date ?: null,
                    'entity' => $this->entity,
                    'consecrated_at' => $this->consecrated_at,
                ]);
            }
        } else {
            $this->user->entityConsecrations()->create([
                'consecration_date' => $this->consecration_date ?: null,
                'entity' => $this->entity,
                'consecrated_at' => $this->consecrated_at,
            ]);
        }

        $this->reset(['consecration_date', 'entity', 'consecrated_at', 'editingId']);
        $this->loadConsecrations();
        session()->flash('message', 'Consagração salva com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $consecration = EntityConsecration::find($id);
        if ($consecration && $consecration->user_id == $this->user->id) {
            $this->editingId = $id;
            $this->consecration_date = $consecration->consecration_date?->format('Y-m-d');
            $this->entity = $consecration->entity;
            $this->consecrated_at = $consecration->consecrated_at;

            // Forçar re-renderização para atualizar os inputs
            // $this->js('$wire.$refresh()');
        }
    }

    public function delete($id)
    {
        $consecration = EntityConsecration::find($id);
        if ($consecration && $consecration->user_id == $this->user->id) {
            $consecration->delete();
            $this->loadConsecrations();
            session()->flash('message', 'Consagração excluída com sucesso!');
        }
    }

    public function cancel()
    {
        $this->reset(['entity', 'name', 'date', 'editingId']);
    }

    public function render()
    {
        return view('livewire.entity-consecration-form');
    }
}
