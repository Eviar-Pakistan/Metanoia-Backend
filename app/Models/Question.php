<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $casts = [
        'option' => 'array',
    ];


    protected $fillable = [
        'question',
        'option',
        'option_1_count',
        'option_2_count',
        'option_3_count',
        'option_4_count',
    ];
}
