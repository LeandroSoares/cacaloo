<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
