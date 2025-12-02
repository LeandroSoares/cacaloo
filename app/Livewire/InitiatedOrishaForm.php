<?php

namespace App\Livewire;

use App\Models\InitiatedOrisha;
use App\Models\Orisha;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InitiatedOrishaForm extends Component
{
    public $user;
    public $initiatedOrishas = [];
    public $availableOrishas = [];
    public $newOrisha = [
        'orisha_id' => '',
        'observations' => '',
    ];
    public $editingOrisha = null;
    public $isEditing = false;

    protected $rules = [
        'newOrisha.orisha_id' => 'required',
        'newOrisha.observations' => 'nullable|string',
    ];

    protected $messages = [
        'newOrisha.orisha_id.required' => 'O orixá é obrigatório.',
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->loadInitiatedOrishas();
        $this->loadAvailableOrishas();
    }

    public function render()
    {
        return view('livewire.initiated-orisha-form');
    }

    public function loadInitiatedOrishas()
    {
        $this->initiatedOrishas = $this->user->initiatedOrishas()->with('orisha')->get()->toArray();
    }

    public function loadAvailableOrishas()
    {
        $this->availableOrishas = Orisha::orderBy('name')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'orisha_id' => $this->newOrisha['orisha_id'],
            'observations' => $this->newOrisha['observations'],
            'initiated' => true,
        ];

        if ($this->isEditing) {
            $this->editingOrisha->update($data);
            session()->flash('message', 'Orixá atualizado com sucesso!');
            $this->cancel();
        } else {
            $this->user->initiatedOrishas()->create($data);
            session()->flash('message', 'Orixá iniciado adicionado com sucesso!');
        }

        $this->resetNewOrisha();
        $this->loadInitiatedOrishas();
        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $orisha = InitiatedOrisha::find($id);
        if ($orisha && $orisha->user_id == $this->user->id) {
            $this->editingOrisha = $orisha;
            $this->isEditing = true;
            $this->newOrisha = [
                'orisha_id' => $orisha->orisha_id,
                'observations' => $orisha->observations ?? '',
            ];
        }
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->editingOrisha = null;
        $this->resetNewOrisha();
    }

    public function delete($id)
    {
        $initiatedOrisha = InitiatedOrisha::find($id);

        if ($initiatedOrisha && $initiatedOrisha->user_id == $this->user->id) {
            $initiatedOrisha->delete();
            $this->loadInitiatedOrishas();
            session()->flash('message', 'Orixá removido com sucesso!');
            $this->dispatch('profile-updated');
        }
    }

    private function resetNewOrisha()
    {
        $this->newOrisha = [
            'orisha_id' => '',
            'observations' => '',
        ];
    }
}
