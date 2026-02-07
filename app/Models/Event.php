<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Enums\ContentVisibility;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'location',
        'event_date',
        'event_end_date',
        'visibility', // Adicionado
        'is_featured',
        'is_visible',
        'status',
        'custom_data',
        'sort_order',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_end_date' => 'datetime',
        'visibility' => ContentVisibility::class, // Adicionado
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'custom_data' => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('event_date');
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->event_date->isFuture();
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date->format('d/m/Y H:i');
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
