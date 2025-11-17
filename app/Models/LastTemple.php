<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $leader_name
 * @property string|null $function
 * @property string|null $exit_reason
 */
class LastTemple extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'leader_name',
        'function',
        'exit_reason',
    ];

    /**
     * Usuário ao qual este último templo pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
