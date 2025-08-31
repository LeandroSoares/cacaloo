<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\LastTemple;

class LastTempleForm extends Component
{
    public User $user;
    public $name = null;
    public $address = null;
    public $leader_name = null;
    public $function = null;
    public $exit_reason = null;

    public function mount(User $user)
    {
        $this->user = $user;

        if ($user->lastTemple) {
            $this->name = $user->lastTemple->name;
            $this->address = $user->lastTemple->address;
            $this->leader_name = $user->lastTemple->leader_name;
            $this->function = $user->lastTemple->function;
            $this->exit_reason = $user->lastTemple->exit_reason;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'leader_name' => 'nullable|string|max:255',
            'function' => 'nullable|string|max:255',
            'exit_reason' => 'nullable|string',
        ]);

        $this->user->lastTemple()->updateOrCreate(
            ['user_id' => $this->user->id],
            $validatedData
        );

        session()->flash('message', 'Informações do último templo salvas com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.last-temple-form');
    }
}
