<?php

namespace App\Livewire;

use Livewire\Component;


use App\Models\PersonalData;
use Illuminate\Support\Facades\Auth;

class PersonalDataForm extends Component
{
    public $name, $address, $zip_code, $email, $cpf, $rg, $birth_date, $home_phone, $mobile_phone, $work_phone, $emergency_contact;

    public function mount()
    {
        $data = PersonalData::where('user_id', Auth::id())->first();
        if ($data) {
            $this->name = $data->name;
            $this->address = $data->address;
            $this->zip_code = $data->zip_code;
            $this->email = $data->email;
            $this->cpf = $data->cpf;
            $this->rg = $data->rg;
            $this->birth_date = $data->birth_date?->format('Y-m-d');
            $this->home_phone = $data->home_phone;
            $this->mobile_phone = $data->mobile_phone;
            $this->work_phone = $data->work_phone;
            $this->emergency_contact = $data->emergency_contact;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'cpf' => 'nullable|string|max:20',
            'rg' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'home_phone' => 'nullable|string|max:20',
            'mobile_phone' => 'nullable|string|max:20',
            'work_phone' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:255',
        ]);

        PersonalData::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated + ['user_id' => Auth::id()]
        );

        session()->flash('message', 'Dados pessoais salvos com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.personal-data-form');
    }
}
