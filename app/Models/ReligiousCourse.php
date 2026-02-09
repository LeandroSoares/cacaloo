<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $course_id
 * @property \DateTime|null $date
 * @property bool $finished
 * @property bool $has_initiation
 * @property \DateTime|null $initiation_date
 * @property string|null $observations
 */
class ReligiousCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'date',
        'finished',
        'has_initiation',
        'initiation_date',
        'observations',
    ];

    protected $casts = [
        'date' => 'date',
        'finished' => 'boolean',
        'has_initiation' => 'boolean',
        'initiation_date' => 'date',
    ];

    /**
     * Usuário ao qual este curso religioso pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Curso relacionado
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
