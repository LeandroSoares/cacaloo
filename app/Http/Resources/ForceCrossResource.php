<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ForceCrossResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'top' => $this->top,
            'bottom' => $this->bottom,
            'left' => $this->left,
            'right' => $this->right,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
