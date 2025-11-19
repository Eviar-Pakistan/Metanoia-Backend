<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'details',
        'duration'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
