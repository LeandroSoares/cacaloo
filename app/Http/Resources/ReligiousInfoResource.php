<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReligiousInfoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'start_location' => $this->start_location,
            'charity_house_start' => $this->charity_house_start?->format('Y-m-d'),
            'charity_house_end' => $this->charity_house_end?->format('Y-m-d'),
            'charity_house_observations' => $this->charity_house_observations,
            'development_start' => $this->development_start?->format('Y-m-d'),
            'development_end' => $this->development_end?->format('Y-m-d'),
            'service_start' => $this->service_start?->format('Y-m-d'),
            'umbanda_baptism' => $this->umbanda_baptism?->format('Y-m-d'),
            'cambone_experience' => $this->cambone_experience,
            'cambone_start_date' => $this->cambone_start_date?->format('Y-m-d'),
            'cambone_end_date' => $this->cambone_end_date?->format('Y-m-d'),
        ];
    }
}
