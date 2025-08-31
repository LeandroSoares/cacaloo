<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReligiousInfo extends Model
{
    protected $table = 'religious_infos';

    protected $fillable = [
        'user_id',
        'start_date',
        'start_location',
        'charity_house_start',
        'charity_house_end',
        'charity_house_observations',
        'development_start',
        'development_end',
        'service_start',
        'umbanda_baptism',
        'cambone_experience',
        'cambone_start_date',
        'cambone_end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'charity_house_start' => 'date',
        'charity_house_end' => 'date',
        'development_start' => 'date',
        'development_end' => 'date',
        'service_start' => 'date',
        'umbanda_baptism' => 'date',
        'cambone_experience' => 'boolean',
        'cambone_start_date' => 'date',
        'cambone_end_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
