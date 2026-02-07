<?php

namespace App\Models\Traits;

use App\Enums\MediumType;

/**
 * Trait para verificações de tipo de médium.
 *
 * Usado pelo Model User para determinar o nível espiritual do usuário.
 */
trait HasMediumType
{
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
}
