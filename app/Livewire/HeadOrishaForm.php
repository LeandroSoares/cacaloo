<?php

namespace App\Livewire;

use App\Models\HeadOrisha;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeadOrishaForm extends Component
{
    public ?string $ancestor = null;
    public ?string $front = null;
    public ?string $frontTogether = null;
    public ?string $adjunct = null;
    public ?string $adjunctTogether = null;
    public ?string $leftSide = null;
    public ?string $leftSideTogether = null;
    public ?string $rightSide = null;
    public ?string $rightSideTogether = null;

    private const STRING_VALIDATION = 'nullable|string|max:255';

    protected array $rules = [
        'ancestor' => self::STRING_VALIDATION,
        'front' => self::STRING_VALIDATION,
        'frontTogether' => self::STRING_VALIDATION,
        'adjunct' => self::STRING_VALIDATION,
        'adjunctTogether' => self::STRING_VALIDATION,
        'leftSide' => self::STRING_VALIDATION,
        'leftSideTogether' => self::STRING_VALIDATION,
        'rightSide' => self::STRING_VALIDATION,
        'rightSideTogether' => self::STRING_VALIDATION,
    ];

    public function mount(): void
    {
        $headOrisha = HeadOrisha::where('user_id', Auth::id())->first();

        if ($headOrisha) {
            $this->ancestor = $headOrisha->ancestor;
            $this->front = $headOrisha->front;
            $this->frontTogether = $headOrisha->front_together;
            $this->adjunct = $headOrisha->adjunct;
            $this->adjunctTogether = $headOrisha->adjunct_together;
            $this->leftSide = $headOrisha->left_side;
            $this->leftSideTogether = $headOrisha->left_side_together;
            $this->rightSide = $headOrisha->right_side;
            $this->rightSideTogether = $headOrisha->right_side_together;
        }
    }

    public function save(): void
    {
        $this->validate();

        HeadOrisha::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'ancestor' => $this->ancestor,
                'front' => $this->front,
                'front_together' => $this->frontTogether,
                'adjunct' => $this->adjunct,
                'adjunct_together' => $this->adjunctTogether,
                'left_side' => $this->leftSide,
                'left_side_together' => $this->leftSideTogether,
                'right_side' => $this->rightSide,
                'right_side_together' => $this->rightSideTogether,
            ]
        );

        session()->flash('message', 'Orixás de cabeça salvos com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.head-orisha-form');
    }
}
