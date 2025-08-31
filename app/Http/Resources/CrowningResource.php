<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CrowningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'guide_name' => $this->guide_name,
            'priest_name' => $this->priest_name,
            'temple_name' => $this->temple_name,
        ];
    }
}
