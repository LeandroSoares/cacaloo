<?php

namespace App\Livewire;

use App\Models\DivineMagic;
use App\Models\MagicType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DivineMagicForm extends Component
{
    public $user;
    public $divineMagics = [];
    public $availableMagicTypes = [];
    public $newMagic = [
        'magic_type_id' => '',
        'date' => '',
        'temple' => '',
        'priest_name' => '',
        'observations' => '',
    ];
    public $editingMagic = null;
    public $isEditing = false;

    protected $rules = [
        'newMagic.magic_type_id' => 'required',
        'newMagic.date' => 'required|date',
        'newMagic.temple' => 'required|string|max:255',
        'newMagic.priest_name' => 'required|string|max:255',
        'newMagic.observations' => 'nullable|string',
    ];

    protected $messages = [
        'newMagic.magic_type_id.required' => 'O tipo de magia é obrigatório.',
        'newMagic.date.required' => 'A data da consagração é obrigatória.',
        'newMagic.date.date' => 'A data da consagração deve ser uma data válida.',
        'newMagic.temple.required' => 'O templo é obrigatório.',
        'newMagic.temple.max' => 'O nome do templo não pode ter mais de 255 caracteres.',
        'newMagic.priest_name.required' => 'O nome do sacerdote é obrigatório.',
        'newMagic.priest_name.max' => 'O nome do sacerdote não pode ter mais de 255 caracteres.',
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->loadDivineMagics();
        $this->loadAvailableMagicTypes();
    }

    public function render()
    {
        return view('livewire.divine-magic-form');
    }

    public function loadDivineMagics()
    {
        $this->divineMagics = $this->user->divineMagics()->with('magicType')->get()->toArray();
    }

    public function loadAvailableMagicTypes()
    {
        $this->availableMagicTypes = MagicType::orderBy('name')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'magic_type_id' => $this->newMagic['magic_type_id'],
            'date' => $this->newMagic['date'],
            'temple' => $this->newMagic['temple'],
            'priest_name' => $this->newMagic['priest_name'],
            'observations' => $this->newMagic['observations'],
        ];

        if ($this->isEditing) {
            $this->editingMagic->update($data);
            session()->flash('message', 'Magia divina atualizada com sucesso!');
            $this->cancel();
        } else {
            $this->user->divineMagics()->create($data);
            session()->flash('message', 'Magia divina adicionada com sucesso!');
        }

        $this->resetNewMagic();
        $this->loadDivineMagics();
        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $magic = DivineMagic::find($id);
        if ($magic && $magic->user_id == $this->user->id) {
            $this->editingMagic = $magic;
            $this->isEditing = true;
            $this->newMagic = [
                'magic_type_id' => $magic->magic_type_id,
                'date' => $magic->date?->format('Y-m-d') ?? '',
                'temple' => $magic->temple ?? '',
                'priest_name' => $magic->priest_name ?? '',
                'observations' => $magic->observations ?? '',
            ];
        }
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->editingMagic = null;
        $this->resetNewMagic();
    }

    public function delete($id)
    {
        $divineMagic = DivineMagic::find($id);

        if ($divineMagic && $divineMagic->user_id == $this->user->id) {
            $divineMagic->delete();
            $this->loadDivineMagics();
            session()->flash('message', 'Magia divina removida com sucesso!');
            $this->dispatch('profile-updated');
        }
    }

    private function resetNewMagic()
    {
        $this->newMagic = [
            'magic_type_id' => '',
            'date' => '',
            'temple' => '',
            'priest_name' => '',
            'observations' => '',
        ];
    }
}
