<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property string|null $description
 */
class Mystery extends Model
{
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
