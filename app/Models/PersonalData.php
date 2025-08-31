<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $zip_code
 * @property string $email
 * @property string|null $cpf
 * @property string|null $rg
 * @property \DateTime $birth_date
 * @property string|null $home_phone
 * @property string $mobile_phone
 * @property string|null $work_phone
 * @property string|null $emergency_contact
 */
class PersonalData extends Model
{
    protected $table = 'personal_data';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'zip_code',
        'email',
        'cpf',
        'rg',
        'birth_date',
        'home_phone',
        'mobile_phone',
        'work_phone',
        'emergency_contact',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
