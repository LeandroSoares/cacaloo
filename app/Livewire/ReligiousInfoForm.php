<?php

namespace App\Livewire;

use Livewire\Component;


use App\Models\ReligiousInfo;
use Illuminate\Support\Facades\Auth;

class ReligiousInfoForm extends Component
{
    public $start_date;
    public $start_location;
    public $charity_house_start;
    public $charity_house_end;
    public $charity_house_observations;
    public $development_start;
    public $development_end;
    public $service_start;
    public $umbanda_baptism;
    public $cambone_experience;
    public $cambone_start_date;
    public $cambone_end_date;

    public function mount()
    {
        $data = ReligiousInfo::where('user_id', Auth::id())->first();
        if ($data) {
            $this->start_date = $data->start_date?->format('Y-m-d');
            $this->start_location = $data->start_location;
            $this->charity_house_start = $data->charity_house_start?->format('Y-m-d');
            $this->charity_house_end = $data->charity_house_end?->format('Y-m-d');
            $this->charity_house_observations = $data->charity_house_observations;
            $this->development_start = $data->development_start?->format('Y-m-d');
            $this->development_end = $data->development_end?->format('Y-m-d');
            $this->service_start = $data->service_start?->format('Y-m-d');
            $this->umbanda_baptism = $data->umbanda_baptism?->format('Y-m-d');
            $this->cambone_experience = $data->cambone_experience;
            $this->cambone_start_date = $data->cambone_start_date?->format('Y-m-d');
            $this->cambone_end_date = $data->cambone_end_date?->format('Y-m-d');
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'start_date' => 'nullable|date',
            'start_location' => 'nullable|string|max:255',
            'charity_house_start' => 'nullable|date',
            'charity_house_end' => 'nullable|date',
            'charity_house_observations' => 'nullable|string|max:1000',
            'development_start' => 'nullable|date',
            'development_end' => 'nullable|date',
            'service_start' => 'nullable|date',
            'umbanda_baptism' => 'nullable|date',
            'cambone_experience' => 'boolean',
            'cambone_start_date' => 'nullable|date',
            'cambone_end_date' => 'nullable|date',
        ]);

        ReligiousInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated + ['user_id' => Auth::id()]
        );

        session()->flash('message', 'Informações religiosas salvas com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.religious-info-form');
    }
}
