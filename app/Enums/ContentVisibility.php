<?php

namespace App\Enums;

enum ContentVisibility: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Público (Todos)',
            self::PRIVATE => 'Privado (Logados)',
        };
    }
}
