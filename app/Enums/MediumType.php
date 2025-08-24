<?php

namespace App\Enums;

enum MediumType: string
{
    case INICIANTE = 'iniciante';
    case DESENVOLVIDO = 'desenvolvido';
    case PAI_MAE_PEQUENO = 'pai_mae_pequeno';
    case SACERDOTE = 'sacerdote';

    /**
     * Retorna uma descrição amigável para o tipo de médium
     */
    public function label(): string
    {
        return match($this) {
            self::INICIANTE => 'Médium Iniciante',
            self::DESENVOLVIDO => 'Médium Desenvolvido',
            self::PAI_MAE_PEQUENO => 'Pai/Mãe Pequeno(a)',
            self::SACERDOTE => 'Sacerdote/Sacerdotisa',
        };
    }

    /**
     * Retorna todos os tipos como array para formulários
     */
    public static function asSelectArray(): array
    {
        return [
            self::INICIANTE->value => self::INICIANTE->label(),
            self::DESENVOLVIDO->value => self::DESENVOLVIDO->label(),
            self::PAI_MAE_PEQUENO->value => self::PAI_MAE_PEQUENO->label(),
            self::SACERDOTE->value => self::SACERDOTE->label(),
        ];
    }
}
