<?php

namespace App\Models;

use App\Enums\ContentType;
use App\Enums\ContentVisibility;
use App\Models\Traits\CacheableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory, CacheableModel;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'type',
        'visibility',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'type' => ContentType::class,
        'visibility' => ContentVisibility::class,
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope para retornar apenas conteúdos publicados e ativos
     */
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    } /** * Scope para filtrar por visibilidade pública */
    public function
        scopePublic(
        $query
    ) {
        return $query->where('visibility', ContentVisibility::PUBLIC);
    }
}
