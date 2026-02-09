<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $orisha_id
 * @property bool $initiated
 * @property string|null $observations
 */
class InitiatedOrisha extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'orisha_id',
        'initiated',
        'observations',
    ];

    protected $casts = [
        'initiated' => 'boolean',
    ];

    /**
     * Usuário ao qual este orixá iniciado pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Orixá relacionado
     */
    public function orisha(): BelongsTo
    {
        return $this->belongsTo(Orisha::class);
    }
}
