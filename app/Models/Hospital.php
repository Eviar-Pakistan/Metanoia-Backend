<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address', 
        'city',
        'state',
        'phone_number',
        'email',
        'license_number',
        'established_date',
        'manager_id',
        'department_id',
        'postal_code'
    ];

    protected $casts = [
        'established_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the manager that manages this hospital.
     */
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    /**
     * Get the department this hospital belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the doctors that work at this hospital.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Get the patients registered at this hospital.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
