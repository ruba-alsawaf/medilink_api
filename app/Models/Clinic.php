<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'partner_id',
        'name',
        'city',
        'type'
    ];

    protected static $filtersArray = [
        'name' => 'like',
        'city' => 'like',
        'type' => 'equal',
        'partner_id' => 'equal',
        'created_at' => 'date',
    ];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public function entities()
    {
        return $this->morphMany(Entity::class, 'model');
    }

}
