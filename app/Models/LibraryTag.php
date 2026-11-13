<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class LibraryTag extends Model
{
    use HasFactory;

    public const MAX_NAME_LENGTH = 36;

    public const NAME_REGEX = '/^[\p{L}\p{N}\s\-]+$/u';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(LibraryFile::class, 'library_file_tag');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    public static function resolveFromNames(array $rawTagNames): array
    {
        $tagIds = [];

        foreach ($rawTagNames as $rawName) {
            $cleanName = preg_replace('/\s+/u', ' ', trim((string) $rawName)) ?? '';
            if ($cleanName === '') {
                continue;
            }

            $slug = Str::slug($cleanName) ?: Str::lower($cleanName);

            $tag = static::firstOrCreate(
                ['slug' => $slug],
                ['name' => Str::limit($cleanName, self::MAX_NAME_LENGTH, '')]
            );

            $tagIds[] = $tag->id;
        }

        return array_values(array_unique($tagIds));
    }
}
