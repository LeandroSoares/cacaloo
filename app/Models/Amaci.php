<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $type
 * @property string|null $observations
 * @property \DateTime|null $date
 */
class Amaci extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'observations',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Usuário ao qual este amaci pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
