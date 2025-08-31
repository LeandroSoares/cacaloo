<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Crossing;
use App\Http\Requests\CrossingRequest;
use Illuminate\Support\Facades\Auth;

class CrossingForm extends Component
{
    public $date;
    public $entity;
    public $purpose;

    public function mount()
    {
        $record = Crossing::where('user_id', Auth::id())->first();
        if ($record) {
            $this->date = $record->date;
            $this->entity = $record->entity;
            $this->purpose = $record->purpose;
        }
    }

    public function save()
    {
        $data = $this->validate((new CrossingRequest())->rules());
        Crossing::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($data, ['user_id' => Auth::id()])
        );
        session()->flash('message', 'Dados salvos com sucesso!');
    }

    public function render()
    {
        return view('livewire.crossing-form');
    }
}
