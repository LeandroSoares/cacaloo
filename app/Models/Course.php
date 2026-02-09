<?php

namespace App\Models;

use App\Models\Traits\CacheableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property string|null $description
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use CacheableModel, HasFactory;

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
