<?php

namespace App\Models;

use App\Models\Traits\CacheableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_right
 * @property bool $is_left
 * @property bool $active
 */
class Orisha extends Model
{
    use CacheableModel;

    protected $fillable = [
        'name',
        'type_orisha',
        'throne',
        'description',
        'text',
        'oferings',
        'is_right',
        'is_left',
        'active',
    ];

    protected $casts = [
        'is_right' => 'boolean',
        'is_left' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Orixás iniciados pelos usuários
     */
    public function initiatedOrishas(): HasMany
    {
        return $this->hasMany(InitiatedOrisha::class);
    }
}
