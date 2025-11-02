<?php

namespace App\Livewire;

use App\Models\InitiatedMystery;
use App\Models\Mystery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InitiatedMysteryForm extends Component
{
    public $user;
    public $initiatedMysteries = [];
    public $availableMysteries = [];
    public $newMystery = [
        'mystery_id' => '',
        'date' => '',
        'temple' => '',
        'priest_name' => '',
        'observations' => '',
    ];
    public $editingMystery = null;
    public $isEditing = false;

    protected $rules = [
        'newMystery.mystery_id' => 'required',
        'newMystery.date' => 'required|date',
        'newMystery.temple' => 'required|string|max:255',
        'newMystery.priest_name' => 'required|string|max:255',
        'newMystery.observations' => 'nullable|string',
    ];

    protected $messages = [
        'newMystery.mystery_id.required' => 'O mistério é obrigatório.',
        'newMystery.date.required' => 'A data da iniciação é obrigatória.',
        'newMystery.date.date' => 'A data da iniciação deve ser uma data válida.',
        'newMystery.temple.required' => 'O templo é obrigatório.',
        'newMystery.temple.max' => 'O nome do templo não pode ter mais de 255 caracteres.',
        'newMystery.priest_name.required' => 'O nome do sacerdote é obrigatório.',
        'newMystery.priest_name.max' => 'O nome do sacerdote não pode ter mais de 255 caracteres.',
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->loadInitiatedMysteries();
        $this->loadAvailableMysteries();
    }

    public function render()
    {
        return view('livewire.initiated-mystery-form');
    }

    public function loadInitiatedMysteries()
    {
        $this->initiatedMysteries = $this->user->initiatedMysteries()->with('mystery')->get()->toArray();
    }

    public function loadAvailableMysteries()
    {
        $this->availableMysteries = Mystery::orderBy('name')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'mystery_id' => $this->newMystery['mystery_id'],
            'date' => $this->newMystery['date'],
            'temple' => $this->newMystery['temple'],
            'priest_name' => $this->newMystery['priest_name'],
            'observations' => $this->newMystery['observations'],
        ];

        if ($this->isEditing) {
            $this->editingMystery->update($data);
            session()->flash('message', 'Mistério atualizado com sucesso!');
            $this->cancel();
        } else {
            $this->user->initiatedMysteries()->create($data);
            session()->flash('message', 'Mistério iniciado adicionado com sucesso!');
        }

        $this->resetNewMystery();
        $this->loadInitiatedMysteries();
        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $mystery = InitiatedMystery::find($id);
        if ($mystery && $mystery->user_id === $this->user->id) {
            $this->editingMystery = $mystery;
            $this->isEditing = true;
            $this->newMystery = [
                'mystery_id' => $mystery->mystery_id,
                'date' => $mystery->date?->format('Y-m-d') ?? '',
                'temple' => $mystery->temple ?? '',
                'priest_name' => $mystery->priest_name ?? '',
                'observations' => $mystery->observations ?? '',
            ];
        }
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->editingMystery = null;
        $this->resetNewMystery();
    }

    public function delete($id)
    {
        $initiatedMystery = InitiatedMystery::find($id);

        if ($initiatedMystery && $initiatedMystery->user_id === $this->user->id) {
            $initiatedMystery->delete();
            $this->loadInitiatedMysteries();
            session()->flash('message', 'Mistério removido com sucesso!');
            $this->dispatch('profile-updated');
        }
    }

    private function resetNewMystery()
    {
        $this->newMystery = [
            'mystery_id' => '',
            'date' => '',
            'temple' => '',
            'priest_name' => '',
            'observations' => '',
        ];
    }
}
