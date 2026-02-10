<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkGuideUserValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'value',
    ];

    /**
     * Usuário ao qual este guia de trabalho pertence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Categoria do guia de trabalho
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkGuideCategory::class, 'category_id');
    }
}
