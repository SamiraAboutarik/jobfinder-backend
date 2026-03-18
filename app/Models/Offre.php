<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    // Important : on pointe sur "offres" et non "jobs"
    protected $table = 'offres';

    protected $fillable = [
        'title', 'company', 'logo', 'color',
        'city', 'salary', 'type', 'description',
        'tags', 'is_active',
    ];

    protected $casts = [
        'tags'      => 'array',
        'is_active' => 'boolean',
        'salary'    => 'integer',
    ];

    // Relations
    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'offre_id');
    }

    public function favorisUsers()
    {
        return $this->belongsToMany(User::class, 'favoris', 'offre_id', 'user_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFiltre($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function ($q) use ($s) {
                $q->where('title',       'like', "%$s%")
                  ->orWhere('company',   'like', "%$s%")
                  ->orWhere('description','like', "%$s%");
            });
        }

        if (!empty($filters['city']) && $filters['city'] !== 'Toutes') {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['type']) && $filters['type'] !== 'Tous') {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['salary']) && $filters['salary'] !== 'Tous') {
            match ($filters['salary']) {
                '0-10k'   => $query->where('salary', '<', 10000),
                '10k-15k' => $query->whereBetween('salary', [10000, 14999]),
                '15k-20k' => $query->whereBetween('salary', [15000, 19999]),
                '20k+'    => $query->where('salary', '>=', 20000),
                default   => null,
            };
        }

        return $query;
    }
}
