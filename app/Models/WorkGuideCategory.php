<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkGuideCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Valores de guias de trabalho relacionados a esta categoria
     */
    public function userValues(): HasMany
    {
        return $this->hasMany(WorkGuideUserValue::class, 'category_id');
    }

    /**
     * Scope: apenas categorias ativas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: ordenar por display_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
