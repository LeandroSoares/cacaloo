<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $caboclo
 * @property string|null $cabocla
 * @property string|null $ogum
 * @property string|null $xango
 * @property string|null $baiano
 * @property string|null $baiana
 * @property string|null $preto_velho
 * @property string|null $preta_velha
 * @property string|null $marinheiro
 * @property string|null $ere
 * @property string|null $exu
 * @property string|null $pombagira
 * @property string|null $exu_mirim
 */
class WorkGuide extends Model
{
    protected $fillable = [
        'user_id',
        'caboclo',
        'cabocla',
        'ogum',
        'xango',
        'baiano',
        'baiana',
        'preto_velho',
        'preta_velha',
        'marinheiro',
        'ere',
        'exu',
        'pombagira',
        'exu_mirim',
    ];

    /**
     * Usuário ao qual estes guias de trabalho pertencem
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
