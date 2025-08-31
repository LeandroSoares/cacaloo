<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Invitation extends Model
{
    use HasFactory;
    /**
     * Status possíveis para um convite
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * O período padrão de validade de um convite em dias
     */
    public const DEFAULT_EXPIRATION_DAYS = 7;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'invited_by',
        'status',
        'expires_at',
        'accepted_at',
        'accepted_by',
    ];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'accepted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Relação com o usuário que enviou o convite
     */
    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Relação com o usuário que aceitou o convite
     */
    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    /**
     * Verifica se o convite já foi aceito
     */
    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    /**
     * Verifica se o convite expirou
     */
    public function isExpired(): bool
    {
        return $this->status === self::STATUS_EXPIRED || $this->expires_at->isPast();
    }

    /**
     * Verifica se o convite foi cancelado
     */
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Verifica se o convite está pendente
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Verifica se o convite ainda é válido
     */
    public function isValid(): bool
    {
        if ($this->isAccepted() || $this->isCancelled()) {
            return false;
        }

        if ($this->expires_at->isPast() && $this->status !== self::STATUS_EXPIRED) {
            $this->markAsExpired();
            return false;
        }

        return true;
    }

    /**
     * Marca o convite como aceito
     */
    public function markAsAccepted(?int $userId = null): void
    {
        $this->status = self::STATUS_ACCEPTED;
        $this->accepted_at = now();
        $this->accepted_by = $userId;
        $this->save();
    }

    /**
     * Marca o convite como expirado
     */
    public function markAsExpired(): void
    {
        $this->status = self::STATUS_EXPIRED;
        $this->save();
    }

    /**
     * Marca o convite como cancelado
     */
    public function markAsCancelled(): void
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    /**
     * Gera um novo token de convite
     */
    public static function generateToken(): string
    {
        return Str::random(64);
    }

    /**
     * O hook boot inicializa automaticamente uma data de expiração
     * para novos convites se não for fornecida explicitamente.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            if (!$invitation->expires_at) {
                $invitation->expires_at = now()->addDays(self::DEFAULT_EXPIRATION_DAYS);
            }
        });
    }
}
