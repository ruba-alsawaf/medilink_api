<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
       use HasFactory, Filterable;

   protected $fillable = ['name', 'contact_email'];

    protected static $filtersArray = [
        'name' => 'like',
        'contact_email' => 'like',
        'created_at' => 'date',
    ];

    public function clinics(): HasMany
    {
        return $this->hasMany(Clinic::class);
    }

    public function entities()
    {
        return $this->morphMany(Entity::class, 'model');
    }

    public function scopeClinicsCount($query, $value)
    {
        return $query->withCount('clinics')->having('clinics_count', '>=', $value);
    }
}
