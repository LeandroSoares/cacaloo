<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
    ];

    public function scopeByKey($query, string $key)
    {
        return $query->where('key', $key);
    }

    public function scopeByGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    public static function getValue(string $key, $default = null)
    {
        $setting = static::byKey($key)->first();

        if (! $setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => (bool) $setting->value,
            'number' => (float) $setting->value,
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    public static function setValue(string $key, $value, string $type = 'text'): self
    {
        $processedValue = match ($type) {
            'boolean' => $value ? '1' : '0',
            'json' => json_encode($value),
            default => (string) $value,
        };

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $processedValue,
                'type' => $type,
            ]
        );
    }

    public function getCastedValue()
    {
        return match ($this->type) {
            'boolean' => (bool) $this->value,
            'number' => (float) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}
