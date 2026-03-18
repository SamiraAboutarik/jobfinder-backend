<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company', 'logo', 'color', 'city',
        'salary', 'type', 'description', 'tags', 'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
        'salary' => 'integer',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%$s%")
                  ->orWhere('company', 'like', "%$s%")
                  ->orWhere('description', 'like', "%$s%");
            });
        }

        if (!empty($filters['city']) && $filters['city'] !== 'Toutes') {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['type']) && $filters['type'] !== 'Tous') {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['salary'])) {
            match ($filters['salary']) {
                '0-10k'    => $query->where('salary', '<', 10000),
                '10k-15k'  => $query->whereBetween('salary', [10000, 14999]),
                '15k-20k'  => $query->whereBetween('salary', [15000, 19999]),
                '20k+'     => $query->where('salary', '>=', 20000),
                default    => null,
            };
        }

        return $query;
    }
}
