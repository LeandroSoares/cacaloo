<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $magic_type_id
 * @property \DateTime|null $date
 * @property string $temple
 * @property string $priest_name
 * @property string|null $observations
 */
class DivineMagic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'magic_type_id',
        'date',
        'temple',
        'priest_name',
        'observations',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Usuário ao qual esta magia divina pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tipo de magia relacionado
     */
    public function magicType(): BelongsTo
    {
        return $this->belongsTo(MagicType::class);
    }
}
