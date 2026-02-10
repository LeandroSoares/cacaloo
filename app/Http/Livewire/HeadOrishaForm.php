<?php

namespace App\Http\Livewire;

use App\Http\Requests\HeadOrishaRequest;
use App\Models\HeadOrisha;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeadOrishaForm extends Component
{
    public $ancestor;

    public $front;

    public $front_together;

    public $back;

    public $back_together;

    public $right;

    public $left;

    public $crown;

    public $base;

    public function mount()
    {
        $record = HeadOrisha::where('user_id', Auth::id())->first();
        if ($record) {
            $this->ancestor = $record->ancestor;
            $this->front = $record->front;
            $this->front_together = $record->front_together;
            $this->back = $record->back;
            $this->back_together = $record->back_together;
            $this->right = $record->right;
            $this->left = $record->left;
            $this->crown = $record->crown;
            $this->base = $record->base;
        }
    }

    public function save()
    {
        $data = $this->validate((new HeadOrishaRequest)->rules());
        HeadOrisha::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($data, ['user_id' => Auth::id()])
        );
        session()->flash('message', 'Dados salvos com sucesso!');
    }

    public function render()
    {
        return view('livewire.head-orisha-form');
    }
}
