<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeSectionCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_section_id',
        'title',
        'content',
        'image',
        'icon',
        'link_url',
        'link_text',
        'custom_data',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'custom_data' => 'array',
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function homeSection(): BelongsTo
    {
        return $this->belongsTo(HomeSection::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getCustomDataAttribute($value): array
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setCustomDataAttribute($value): void
    {
        $this->attributes['custom_data'] = is_array($value) ? json_encode($value) : $value;
    }
}
