<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'video',
        'image',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
