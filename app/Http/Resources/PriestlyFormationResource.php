<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriestlyFormationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'theology_start' => $this->theology_start?->format('Y-m-d'),
            'theology_end' => $this->theology_end?->format('Y-m-d'),
            'priesthood_start' => $this->priesthood_start?->format('Y-m-d'),
            'priesthood_end' => $this->priesthood_end?->format('Y-m-d'),
        ];
    }
}
