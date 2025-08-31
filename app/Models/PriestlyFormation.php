<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriestlyFormation extends Model
{
    protected $table = 'priestly_formations';

    protected $fillable = [
        'user_id',
        'theology_start',
        'theology_end',
        'priesthood_start',
        'priesthood_end',
    ];

    protected $casts = [
        'theology_start' => 'date',
        'theology_end' => 'date',
        'priesthood_start' => 'date',
        'priesthood_end' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
