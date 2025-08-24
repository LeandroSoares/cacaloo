<?php

namespace App\Enums;

enum AssignmentType: string
{
    case OGA = 'oga';
    case CAMBONE = 'cambone';
    case MEDIUM_TRABALHO = 'medium_trabalho';
    case MEDIUM_CURA = 'medium_cura';

    public function label(): string
    {
        return match($this) {
            self::OGA => 'Ogã',
            self::CAMBONE => 'Cambone',
            self::MEDIUM_TRABALHO => 'Médium de Trabalho',
            self::MEDIUM_CURA => 'Médium de Cura',
        };
    }
}
