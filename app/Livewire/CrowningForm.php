<?php

namespace App\Livewire;

use App\Services\CrowningService;
use Livewire\Component;

class CrowningForm extends Component
{
    private const MAX_LENGTH = 255;

    public string $start_date = '';

    public string $end_date = '';

    public string $guide_name = '';

    public string $priest_name = '';

    public string $temple_name = '';

    public function mount()
    {
        $crowning = \App\Models\Crowning::where('user_id', auth()->id())->first();
        if ($crowning) {
            $this->start_date = $crowning->start_date?->format('Y-m-d') ?? '';
            $this->end_date = $crowning->end_date?->format('Y-m-d') ?? '';
            $this->guide_name = $crowning->guide_name ?? '';
            $this->priest_name = $crowning->priest_name ?? '';
            $this->temple_name = $crowning->temple_name ?? '';
        }
    }

    public function rules(): array
    {
        return [
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'guide_name' => ['nullable', 'string', 'max:'.self::MAX_LENGTH],
            'priest_name' => ['nullable', 'string', 'max:'.self::MAX_LENGTH],
            'temple_name' => ['nullable', 'string', 'max:'.self::MAX_LENGTH],
        ];
    }

    public function save(CrowningService $service): void
    {
        $this->validate();
        $service->store([
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'guide_name' => $this->guide_name ?: null,
            'priest_name' => $this->priest_name ?: null,
            'temple_name' => $this->temple_name ?: null,
        ]);
        // Não resetar os campos para manter os dados visíveis após salvar
        session()->flash('message', 'Coroação salva com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.crowning-form');
    }
}
