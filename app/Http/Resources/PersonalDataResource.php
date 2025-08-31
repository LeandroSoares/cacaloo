<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'home_phone' => $this->home_phone,
            'mobile_phone' => $this->mobile_phone,
            'work_phone' => $this->work_phone,
            'emergency_contact' => $this->emergency_contact,
        ];
    }
}
