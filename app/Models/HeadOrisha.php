<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeadOrisha extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ancestor',
        'front',
        'front_together',
        'adjunct',
        'adjunct_together',
        'left_side',
        'left_side_together',
        'right_side',
        'right_side_together',
    ];
}
