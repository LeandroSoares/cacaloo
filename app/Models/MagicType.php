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
class MagicType extends Model
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
     * Magias divinas realizadas pelos usuários
     */
    public function divineMagics(): HasMany
    {
        return $this->hasMany(DivineMagic::class, 'magic_type_id');
    }
}
