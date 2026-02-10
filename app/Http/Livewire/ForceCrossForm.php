<?php

namespace App\Http\Livewire;

use App\Http\Requests\ForceCrossRequest;
use App\Models\ForceCross;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForceCrossForm extends Component
{
    public $top;

    public $bottom;

    public $left;

    public $right;

    public function mount()
    {
        $record = ForceCross::where('user_id', Auth::id())->first();
        if ($record) {
            $this->top = $record->top;
            $this->bottom = $record->bottom;
            $this->left = $record->left;
            $this->right = $record->right;
        }
    }

    public function save()
    {
        $data = $this->validate((new ForceCrossRequest)->rules());
        ForceCross::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($data, ['user_id' => Auth::id()])
        );
        session()->flash('message', 'Dados salvos com sucesso!');
    }

    public function render()
    {
        return view('livewire.force-cross-form');
    }
}
