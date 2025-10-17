<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Entity extends Authenticatable
{
    use HasApiTokens, HasFactory, Filterable,Notifiable;

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

}
