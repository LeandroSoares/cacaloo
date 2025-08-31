<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeadOrishaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'ancestor' => $this->ancestor,
            'front' => $this->front,
            'front_together' => $this->front_together,
            'back' => $this->back,
            'back_together' => $this->back_together,
            'right' => $this->right,
            'left' => $this->left,
            'crown' => $this->crown,
            'base' => $this->base,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
