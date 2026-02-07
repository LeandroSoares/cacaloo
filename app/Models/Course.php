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
use App\Models\Traits\CacheableModel;

class Course extends Model
{
    use CacheableModel;

    protected $fillable = [
        'name',
        'active',
        'description',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Cursos religiosos realizados pelos usuários
     */
    public function religiousCourses(): HasMany
    {
        return $this->hasMany(ReligiousCourse::class);
    }
}
