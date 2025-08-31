<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ForceCross;

class ForceCrossForm extends Component
{
    public User $user;
    public $top = null;
    public $bottom = null;
    public $left = null;
    public $right = null;

    public function mount(User $user)
    {
        $this->user = $user;

        if ($user->forceCross) {
            $this->top = $user->forceCross->top;
            $this->bottom = $user->forceCross->bottom;
            $this->left = $user->forceCross->left;
            $this->right = $user->forceCross->right;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'top' => 'nullable|string|max:255',
            'bottom' => 'nullable|string|max:255',
            'left' => 'nullable|string|max:255',
            'right' => 'nullable|string|max:255',
        ]);

        $this->user->forceCross()->updateOrCreate(
            ['user_id' => $this->user->id],
            $validatedData
        );

        session()->flash('message', 'Cruz de força salva com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.force-cross-form');
    }
}
