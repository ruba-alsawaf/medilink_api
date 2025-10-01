<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'model_type',
        'model_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static $filtersArray = [
        'name' => 'like',
        'email' => 'like',
        'role' => 'equal',
        'model_type' => 'equal',
        'created_at' => 'date',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function isPartnerAdmin(): bool
    {
        return $this->role === 'partner_admin';
    }

    public function isClinicAdmin(): bool
    {
        return $this->role === 'clinic_admin';
    }

    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['partner_admin', 'clinic_admin']);
    }

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function scopeModelType($query, $type)
    {
        return $query->where('model_type', $type);
    }
}
