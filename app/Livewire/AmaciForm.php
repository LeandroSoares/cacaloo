<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Amaci;

class AmaciForm extends Component
{
    public User $user;
    public $amacis = [];
    public $type = null;
    public $observations = null;
    public $date = null;
    public $editingId = null;

    protected $rules = [
        'type' => 'nullable|string|max:255',
        'observations' => 'nullable|string',
        'date' => 'nullable|date',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadAmacis();
    }

    public function loadAmacis()
    {
        $this->amacis = $this->user->amacis()->orderBy('date', 'desc')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $amaci = Amaci::find($this->editingId);
            if ($amaci && $amaci->user_id == $this->user->id) {
                $amaci->update([
                    'type' => $this->type,
                    'observations' => $this->observations,
                    'date' => $this->date,
                ]);
            }
        } else {
            $this->user->amacis()->create([
                'type' => $this->type,
                'observations' => $this->observations,
                'date' => $this->date,
            ]);
        }

        $this->reset(['type', 'observations', 'date', 'editingId']);
        $this->loadAmacis();
        session()->flash('message', 'Amaci salvo com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $amaci = Amaci::find($id);
        if ($amaci && $amaci->user_id == $this->user->id) {
            $this->editingId = $id;
            $this->type = $amaci->type;
            $this->observations = $amaci->observations;
            $this->date = $amaci->date?->format('Y-m-d');
        }
    }

    public function delete($id)
    {
        $amaci = Amaci::find($id);
        if ($amaci && $amaci->user_id == $this->user->id) {
            $amaci->delete();
            $this->loadAmacis();
            session()->flash('message', 'Amaci excluído com sucesso.');
        }
    }

    public function cancel()
    {
        $this->reset(['type', 'observations', 'date', 'editingId']);
    }

    public function render()
    {
        return view('livewire.amaci-form');
    }
}
