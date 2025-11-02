<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailyMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'author',
        'active',
        'valid_from',
        'valid_until',
        'notes',
    ];

    protected $casts = [
        'active' => 'boolean',
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    /**
     * Scope para mensagens ativas.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope para mensagens válidas na data atual.
     */
    public function scopeValid($query, $date = null)
    {
        $date = $date ?: now()->toDateString();

        return $query->where(function ($q) use ($date) {
            $q->whereNull('valid_from')
              ->orWhere('valid_from', '<=', $date);
        })->where(function ($q) use ($date) {
            $q->whereNull('valid_until')
              ->orWhere('valid_until', '>=', $date);
        });
    }

    /**
     * Scope para mensagens disponíveis (ativas e válidas).
     */
    public function scopeAvailable($query, $date = null)
    {
        return $query->active()->valid($date);
    }

    /**
     * Retorna uma mensagem aleatória disponível.
     */
    public static function getRandomMessage($date = null): ?self
    {
        return static::available($date)->inRandomOrder()->first();
    }

    /**
     * Retorna a mensagem do dia (baseada no cache).
     */
    public static function getTodaysMessage(): ?self
    {
        $cacheKey = 'daily_message_' . now()->toDateString();

        return cache()->remember($cacheKey, now()->addDay(), function () {
            return static::getRandomMessage();
        });
    }

    /**
     * Verifica se a mensagem está válida para uma data específica.
     */
    public function isValidForDate($date = null): bool
    {
        $date = $date ? Carbon::parse($date) : now();

        $validFrom = $this->valid_from ? Carbon::parse($this->valid_from) : null;
        $validUntil = $this->valid_until ? Carbon::parse($this->valid_until) : null;

        if ($validFrom && $date->lt($validFrom)) {
            return false;
        }

        if ($validUntil && $date->gt($validUntil)) {
            return false;
        }

        return $this->active;
    }

    /**
     * Verifica se a mensagem está válida para hoje.
     */
    public function isValid(): bool
    {
        return $this->isValidForDate();
    }

    /**
     * Verifica se a mensagem está disponível para exibição (ativa e válida).
     */
    public function isAvailable(): bool
    {
        return $this->active && $this->isValid();
    }

    /**
     * Retorna o período de validade formatado.
     */
    public function getValidityPeriodAttribute(): string
    {
        if (!$this->valid_from && !$this->valid_until) {
            return 'Sempre válida';
        }

        if ($this->valid_from && !$this->valid_until) {
            return 'Válida a partir de ' . $this->valid_from->format('d/m/Y');
        }

        if (!$this->valid_from && $this->valid_until) {
            return 'Válida até ' . $this->valid_until->format('d/m/Y');
        }

        return 'Válida de ' . $this->valid_from->format('d/m/Y') . ' até ' . $this->valid_until->format('d/m/Y');
    }
}
