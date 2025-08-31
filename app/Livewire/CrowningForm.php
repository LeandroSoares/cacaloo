<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CrowningService;


class CrowningForm extends Component
{
    private const MAX_LENGTH = 255;

    public string $startDate = '';
    public string $endDate = '';
    public string $guideName = '';
    public string $priestName = '';
    public string $templeName = '';

    public function rules(): array
    {
        return [
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'guideName' => ['required', 'string', 'max:' . self::MAX_LENGTH],
            'priestName' => ['required', 'string', 'max:' . self::MAX_LENGTH],
            'templeName' => ['required', 'string', 'max:' . self::MAX_LENGTH],
        ];
    }

    public function save(CrowningService $service): void
    {
        $this->validate();
        $service->store([
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'guide_name' => $this->guideName,
            'priest_name' => $this->priestName,
            'temple_name' => $this->templeName,
        ]);
        $this->reset(['startDate', 'endDate', 'guideName', 'priestName', 'templeName']);
        session()->flash('message', 'Coroação salva com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.crowning-form');
    }
}
