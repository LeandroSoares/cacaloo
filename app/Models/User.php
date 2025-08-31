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

    /**
     * Dados pessoais do usuário
     */
    public function personalData()
    {
        return $this->hasOne(PersonalData::class);
    }

    /**
     * Informações religiosas do usuário
     */
    public function religiousInfo()
    {
        return $this->hasOne(ReligiousInfo::class);
    }

    /**
     * Formação sacerdotal do usuário
     */
    public function priestlyFormation()
    {
        return $this->hasOne(PriestlyFormation::class);
    }

    /**
     * Coroações do usuário
     */
    public function crowning()
    {
        return $this->hasOne(Crowning::class);
    }

    /**
     * Orixás de cabeça do usuário
     */
    public function headOrisha()
    {
        return $this->hasOne(HeadOrisha::class);
    }

    /**
     * Cruz de força do usuário
     */
    public function forceCross()
    {
        return $this->hasOne(ForceCross::class);
    }

    /**
     * Cruzamentos do usuário
     */
    public function crossings()
    {
        return $this->hasMany(Crossing::class);
    }

    /**
     * Guias de trabalho do usuário
     */
    public function workGuide()
    {
        return $this->hasOne(WorkGuide::class);
    }

    /**
     * Cursos religiosos do usuário
     */
    public function religiousCourses()
    {
        return $this->hasMany(ReligiousCourse::class);
    }

    /**
     * Mistérios iniciados pelo usuário
     */
    public function initiatedMysteries()
    {
        return $this->hasMany(InitiatedMystery::class);
    }

    /**
     * Orixás iniciados pelo usuário
     */
    public function initiatedOrishas()
    {
        return $this->hasMany(InitiatedOrisha::class);
    }

    /**
     * Magias divinas do usuário
     */
    public function divineMagics()
    {
        return $this->hasMany(DivineMagic::class);
    }

    /**
     * Consagrações de entidades do usuário
     */
    public function entityConsecrations()
    {
        return $this->hasMany(EntityConsecration::class);
    }

    /**
     * Amacis do usuário
     */
    public function amacis()
    {
        return $this->hasMany(Amaci::class);
    }

    /**
     * Último templo do usuário
     */
    public function lastTemple()
    {
        return $this->hasOne(LastTemple::class);
    }
}
