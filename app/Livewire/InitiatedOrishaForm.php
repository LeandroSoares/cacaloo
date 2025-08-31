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
        'date' => '',
        'temple' => '',
        'priest_name' => '',
        'observations' => '',
    ];

    protected $rules = [
        'newOrisha.orisha_id' => 'required',
        'newOrisha.date' => 'required|date',
        'newOrisha.temple' => 'required|string|max:255',
        'newOrisha.priest_name' => 'required|string|max:255',
        'newOrisha.observations' => 'nullable|string',
    ];

    protected $messages = [
        'newOrisha.orisha_id.required' => 'O orixá é obrigatório.',
        'newOrisha.date.required' => 'A data da iniciação é obrigatória.',
        'newOrisha.date.date' => 'A data da iniciação deve ser uma data válida.',
        'newOrisha.temple.required' => 'O templo é obrigatório.',
        'newOrisha.temple.max' => 'O nome do templo não pode ter mais de 255 caracteres.',
        'newOrisha.priest_name.required' => 'O nome do sacerdote é obrigatório.',
        'newOrisha.priest_name.max' => 'O nome do sacerdote não pode ter mais de 255 caracteres.',
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

    public function addOrisha()
    {
        $this->validate();

        $this->user->initiatedOrishas()->create([
            'orisha_id' => $this->newOrisha['orisha_id'],
            'date' => $this->newOrisha['date'],
            'temple' => $this->newOrisha['temple'],
            'priest_name' => $this->newOrisha['priest_name'],
            'observations' => $this->newOrisha['observations'],
        ]);

        $this->resetNewOrisha();
        $this->loadInitiatedOrishas();

        session()->flash('message', 'Orixá iniciado adicionado com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function deleteOrisha($id)
    {
        $initiatedOrisha = InitiatedOrisha::find($id);

        if ($initiatedOrisha && $initiatedOrisha->user_id === $this->user->id) {
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
            'date' => '',
            'temple' => '',
            'priest_name' => '',
            'observations' => '',
        ];
    }
}
