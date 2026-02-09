<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class WorkGuideForm extends Component
{
    public User $user;

    public $caboclo = null;

    public $cabocla = null;

    public $ogum = null;

    public $xango = null;

    public $baiano = null;

    public $baiana = null;

    public $preto_velho = null;

    public $preta_velha = null;

    public $marinheiro = null;

    public $ere = null;

    public $exu = null;

    public $pombagira = null;

    public $exu_mirim = null;

    public function mount(User $user)
    {
        $this->user = $user;

        if ($user->workGuide) {
            $this->caboclo = $user->workGuide->caboclo;
            $this->cabocla = $user->workGuide->cabocla;
            $this->ogum = $user->workGuide->ogum;
            $this->xango = $user->workGuide->xango;
            $this->baiano = $user->workGuide->baiano;
            $this->baiana = $user->workGuide->baiana;
            $this->preto_velho = $user->workGuide->preto_velho;
            $this->preta_velha = $user->workGuide->preta_velha;
            $this->marinheiro = $user->workGuide->marinheiro;
            $this->ere = $user->workGuide->ere;
            $this->exu = $user->workGuide->exu;
            $this->pombagira = $user->workGuide->pombagira;
            $this->exu_mirim = $user->workGuide->exu_mirim;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'caboclo' => 'nullable|string|max:255',
            'cabocla' => 'nullable|string|max:255',
            'ogum' => 'nullable|string|max:255',
            'xango' => 'nullable|string|max:255',
            'baiano' => 'nullable|string|max:255',
            'baiana' => 'nullable|string|max:255',
            'preto_velho' => 'nullable|string|max:255',
            'preta_velha' => 'nullable|string|max:255',
            'marinheiro' => 'nullable|string|max:255',
            'ere' => 'nullable|string|max:255',
            'exu' => 'nullable|string|max:255',
            'pombagira' => 'nullable|string|max:255',
            'exu_mirim' => 'nullable|string|max:255',
        ]);

        $this->user->workGuide()->updateOrCreate(
            ['user_id' => $this->user->id],
            $validatedData
        );

        session()->flash('message', 'Guias de trabalho salvos com sucesso.');

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.work-guide-form');
    }
}
