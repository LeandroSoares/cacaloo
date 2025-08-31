<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Crossing;

class CrossingForm extends Component
{
    public User $user;
    public $crossings = [];
    public $entity = null;
    public $date = null;
    public $purpose = null;
    public $editingId = null;

    protected $rules = [
        'entity' => 'nullable|string|max:255',
        'date' => 'nullable|date',
        'purpose' => 'nullable|string|max:255',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadCrossings();
    }

    public function loadCrossings()
    {
        $this->crossings = $this->user->crossings()->orderBy('date', 'desc')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $crossing = Crossing::find($this->editingId);
            if ($crossing && $crossing->user_id === $this->user->id) {
                $crossing->update([
                    'entity' => $this->entity,
                    'date' => $this->date,
                    'purpose' => $this->purpose,
                ]);
            }
        } else {
            $this->user->crossings()->create([
                'entity' => $this->entity,
                'date' => $this->date,
                'purpose' => $this->purpose,
            ]);
        }

        $this->reset(['entity', 'date', 'purpose', 'editingId']);
        $this->loadCrossings();
        session()->flash('message', 'Cruzamento salvo com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $crossing = Crossing::find($id);
        if ($crossing && $crossing->user_id === $this->user->id) {
            $this->editingId = $id;
            $this->entity = $crossing->entity;
            $this->date = $crossing->date?->format('Y-m-d');
            $this->purpose = $crossing->purpose;
        }
    }

    public function delete($id)
    {
        $crossing = Crossing::find($id);
        if ($crossing && $crossing->user_id === $this->user->id) {
            $crossing->delete();
            $this->loadCrossings();
            session()->flash('message', 'Cruzamento excluído com sucesso.');
        }
    }

    public function cancel()
    {
        $this->reset(['entity', 'date', 'purpose', 'editingId']);
    }

    public function render()
    {
        return view('livewire.crossing-form');
    }
}
