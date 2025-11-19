<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_image',
        'fullname',
        'gender',
        'email',
        'phone_number',
        'experience',
        'specialization_id',
        'hospital_id',
        'created_by',
        'joining_date'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the specialization that this doctor belongs to.
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    /**
     * Get the hospital where this doctor works.
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Get the user who created this doctor record based on role_id.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'role_id');
    }

    /**
     * Get the patients assigned to this doctor.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
