<?php

namespace App\Livewire;

use Livewire\Component;


use App\Models\PriestlyFormation;
use Illuminate\Support\Facades\Auth;

class PriestlyFormationForm extends Component
{
    public $theology_start;
    public $theology_end;
    public $priesthood_start;
    public $priesthood_end;

    public function mount()
    {
        $data = PriestlyFormation::where('user_id', Auth::id())->first();
        if ($data) {
            $this->theology_start = $data->theology_start?->format('Y-m-d');
            $this->theology_end = $data->theology_end?->format('Y-m-d');
            $this->priesthood_start = $data->priesthood_start?->format('Y-m-d');
            $this->priesthood_end = $data->priesthood_end?->format('Y-m-d');
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'theology_start' => 'required|date',
            'theology_end' => 'nullable|date',
            'priesthood_start' => 'required|date',
            'priesthood_end' => 'nullable|date',
        ]);

        PriestlyFormation::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated + ['user_id' => Auth::id()]
        );

        session()->flash('message', 'Formação sacerdotal salva com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.priestly-formation-form');
    }
}
