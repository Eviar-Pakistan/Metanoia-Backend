<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
    ];

    public function video()
    {
        return $this->hasMany(Video::class , 'category_id');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}

