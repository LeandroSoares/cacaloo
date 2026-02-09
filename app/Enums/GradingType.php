<?php

namespace App\Enums;

enum GradingType: string
{
    case MEDIUM_DESENVOLVIMENTO = 'medium_desenvolvimento';
    case MEDIUM_TRABALHO = 'medium_trabalho';
    case MEDIUM_CURA = 'medium_cura';
    case SACERDOTE = 'sacerdote';
    case PAI_PEQUENO = 'pai_pequeno';
    case MAE_PEQUENA = 'mae_pequena';

    public function label(): string
    {
        return match ($this) {
            self::MEDIUM_DESENVOLVIMENTO => 'Médium em Desenvolvimento',
            self::MEDIUM_TRABALHO => 'Médium de Trabalho',
            self::MEDIUM_CURA => 'Médium de Cura',
            self::SACERDOTE => 'Sacerdote/Sacerdotisa',
            self::PAI_PEQUENO => 'Pai Pequeno',
            self::MAE_PEQUENA => 'Mãe Pequena',
        };
    }
}
