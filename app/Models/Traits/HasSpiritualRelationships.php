<?php

namespace App\Models\Traits;

use App\Models\Amaci;
use App\Models\Crossing;
use App\Models\Crowning;
use App\Models\DivineMagic;
use App\Models\EntityConsecration;
use App\Models\ForceCross;
use App\Models\HeadOrisha;
use App\Models\InitiatedMystery;
use App\Models\InitiatedOrisha;
use App\Models\LastTemple;
use App\Models\PersonalData;
use App\Models\PriestlyFormation;
use App\Models\ReligiousCourse;
use App\Models\ReligiousInfo;
use App\Models\UserAssignment;
use App\Models\UserGrading;
use App\Models\WorkGuide;

/**
 * Trait para relacionamentos espirituais do usuário.
 *
 * Agrupa todos os relacionamentos Eloquent relacionados à
 * vida espiritual e religiosa do médium.
 */
trait HasSpiritualRelationships
{
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
     * Guias de trabalho do usuário (nova estrutura dinâmica)
     */
    public function workGuideValues()
    {
        return $this->hasMany(\App\Models\WorkGuideUserValue::class);
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
