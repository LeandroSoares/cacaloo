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
    public $editingOrisha = null;
    public $isEditing = false;

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

    public function save()
    {
        $this->validate();

        $data = [
            'orisha_id' => $this->newOrisha['orisha_id'],
            'date' => $this->newOrisha['date'],
            'temple' => $this->newOrisha['temple'],
            'priest_name' => $this->newOrisha['priest_name'],
            'observations' => $this->newOrisha['observations'],
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
                'date' => $orisha->date?->format('Y-m-d') ?? '',
                'temple' => $orisha->temple ?? '',
                'priest_name' => $orisha->priest_name ?? '',
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
            'date' => '',
            'temple' => '',
            'priest_name' => '',
            'observations' => '',
        ];
    }
}
