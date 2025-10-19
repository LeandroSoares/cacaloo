<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'title_line1',
        'title_line2',
        'subtitle',
        'content',
        'background_image',
        'background_color',
        'custom_data',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'custom_data' => 'array',
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(HomeSectionCard::class)->orderBy('sort_order');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public static function getByKey(string $key): ?self
    {
        return static::where('section_key', $key)->first();
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
