<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForceCross extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'top',
        'bottom',
        'left',
        'right',
    ];
}
