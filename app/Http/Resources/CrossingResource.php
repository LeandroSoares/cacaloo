<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CrossingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'entity' => $this->entity,
            'purpose' => $this->purpose,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
