<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'address',
        'hospital_id',
        'doctor_id'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the patient profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the hospital where this patient is registered.
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Get the doctor assigned to this patient.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
