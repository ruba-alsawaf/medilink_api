<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'clinic_id',
        'name',
        'specialty', 
        'status'
    ];

    protected static $filtersArray = [
        'name' => 'like',
        'specialty' => 'like',
        'status' => 'equal',
        'clinic_id' => 'equal',
        'created_at' => 'date',
    ];

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function entities()
    {
        return $this->morphMany(Entity::class, 'model');
    }

}
