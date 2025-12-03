<?php

namespace App\Models;

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
    protected $fillable = [
        'name',
        'description',
        'text',
        'type_orisha',
        'throne',
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
