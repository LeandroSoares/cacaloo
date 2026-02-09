<?php

namespace App\Livewire;

use App\Models\EntityConsecration;
use App\Models\User;
use Livewire\Component;

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
                    'date' => $this->date ?: null,
                    'entity' => $this->entity,
                    'name' => $this->name,
                ]);
            }
        } else {
            $this->user->entityConsecrations()->create([
                'date' => $this->date ?: null,
                'entity' => $this->entity,
                'name' => $this->name,
            ]);
        }

        $this->reset(['date', 'entity', 'name', 'editingId']);
        $this->loadConsecrations();
        session()->flash('message', 'Consagração salva com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $consecration = EntityConsecration::find($id);
        if ($consecration && $consecration->user_id == $this->user->id) {
            $this->editingId = $id;
            $this->date = $consecration->date?->format('Y-m-d');
            $this->entity = $consecration->entity;
            $this->name = $consecration->name;

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
