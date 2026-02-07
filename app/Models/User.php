<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MediumType;
use App\Models\Traits\HasMediumType;
use App\Models\Traits\HasSpiritualRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    use HasMediumType;
    use HasSpiritualRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'medium_type',
        'development_start_date',
        'medium_notes',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'medium_type' => MediumType::class,
            'development_start_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // Adiciona um escopo global para retornar apenas usuários ativos
        static::addGlobalScope('active', function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Desativa o usuário ao invés de excluí-lo do banco de dados
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Obtém todos os usuários, incluindo os inativos
     */
    public static function getAllIncludingInactive()
    {
        return static::withoutGlobalScope('active')->get();
    }
}
