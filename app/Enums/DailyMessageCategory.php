<?php

namespace App\Enums;

enum DailyMessageCategory: string
{
    case REFLEXAO = 'reflexao';
    case ESPIRITUALIDADE = 'espiritualidade';
    case UMBANDA = 'umbanda';
    case ENSINAMENTOS = 'ensinamentos';
    case ORACOES = 'oracoes';
    case MOTIVACIONAL = 'motivacional';
    case SABEDORIA = 'sabedoria';

    /**
     * Retorna uma descrição amigável para a categoria
     */
    public function getLabel(): string
    {
        return match($this) {
            self::REFLEXAO => 'Reflexão',
            self::ESPIRITUALIDADE => 'Espiritualidade',
            self::UMBANDA => 'Umbanda',
            self::ENSINAMENTOS => 'Ensinamentos',
            self::ORACOES => 'Orações',
            self::MOTIVACIONAL => 'Motivacional',
            self::SABEDORIA => 'Sabedoria',
        };
    }

    /**
     * Retorna todos os tipos como array para formulários
     */
    public static function asSelectArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->getLabel();
        }
        return $array;
    }

    /**
     * Obtém uma categoria pelo valor
     */
    public static function fromValue(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }
        return null;
    }
}
