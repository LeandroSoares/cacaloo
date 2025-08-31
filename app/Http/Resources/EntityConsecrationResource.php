<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityConsecrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'entity' => $this->entity,
            'name' => $this->name,
            'date' => $this->date,
        ];
    }
}
