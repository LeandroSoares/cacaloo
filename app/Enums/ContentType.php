<?php

namespace App\Enums;

enum ContentType: string
{
    case INSTITUCIONAL = 'institucional';
    case TRABALHO = 'trabalho';
    case LENDA = 'lenda';
    case OUTRO = 'outro';

    public function label(): string
    {
        return match ($this) {
            self::INSTITUCIONAL => 'Institucional',
            self::TRABALHO => 'Trabalho Espiritual',
            self::LENDA => 'Lenda / História',
            self::OUTRO => 'Outro',
        };
    }
}
