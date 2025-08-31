<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\EntityConsecrationService;
use Illuminate\Support\Facades\Auth;


class EntityConsecrationForm extends Component
{
    public string $entity = '';
    public ?string $name = null;
    public ?string $date = null;

    public function rules(): array
    {
        return [
            'entity' => ['required', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
        ];
    }

    public function save(EntityConsecrationService $service): void
    {
        $this->validate();
        $service->store([
            'entity' => $this->entity,
            'name' => $this->name,
            'date' => $this->date,
        ]);
        $this->reset(['entity', 'name', 'date']);
        session()->flash('message', 'Consagração salva com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.entity-consecration-form');
    }
}
