<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'joining_date'
    ];

    protected $casts = [
        'joining_date' => 'date'
    ];

    /**
     * Get the user that owns the manager profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the hospitals managed by this manager.
     */
    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}
