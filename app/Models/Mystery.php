<?php

namespace App\Models;

use App\Models\Traits\CacheableModel;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property string|null $description
 */
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mystery extends Model
{
    use CacheableModel;

    protected $fillable = [
        'name',
        'active',
        'description',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Mistérios iniciados pelos usuários
     */
    public function initiatedMysteries(): HasMany
    {
        return $this->hasMany(InitiatedMystery::class);
    }
}
