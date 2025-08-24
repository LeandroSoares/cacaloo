<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MediumType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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
        ];
    }

    /**
     * Verifica se o usuário é um médium (possui type definido)
     */
    public function isMedium(): bool
    {
        return !is_null($this->medium_type);
    }

    /**
     * Verifica se o usuário é um médium iniciante
     */
    public function isInitiateMedium(): bool
    {
        return $this->medium_type === MediumType::INICIANTE;
    }

    /**
     * Verifica se o usuário é um médium desenvolvido
     */
    public function isDevelopedMedium(): bool
    {
        return $this->medium_type === MediumType::DESENVOLVIDO;
    }

    /**
     * Verifica se o usuário é um pai/mãe pequeno(a)
     */
    public function isSmallParent(): bool
    {
        return $this->medium_type === MediumType::PAI_MAE_PEQUENO;
    }

    /**
     * Verifica se o usuário é um sacerdote/sacerdotisa
     */
    public function isPriest(): bool
    {
        return $this->medium_type === MediumType::SACERDOTE;
    }

    /**
     * Graduações espirituais do usuário
     */
    public function gradings()
    {
        return $this->hasMany(UserGrading::class);
    }

    /**
     * Funções desempenhadas pelo usuário no centro
     */
    public function assignments()
    {
        return $this->hasMany(UserAssignment::class);
    }
}
