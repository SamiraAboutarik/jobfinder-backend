<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'city', 'skills', 'cv_path',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'user_id');
    }

    public function favoris()
    {
        return $this->belongsToMany(Offre::class, 'favoris', 'user_id', 'offre_id');
    }
}
