<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $mystery_id
 * @property \DateTime|null $date
 * @property bool $completed
 * @property string|null $observations
 */
class InitiatedMystery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mystery_id',
        'date',
        'completed',
        'observations',
    ];

    protected $casts = [
        'date' => 'date',
        'completed' => 'boolean',
    ];

    /**
     * Usuário ao qual este mistério iniciado pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mistério relacionado
     */
    public function mystery(): BelongsTo
    {
        return $this->belongsTo(Mystery::class);
    }
}
