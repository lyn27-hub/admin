<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoachingTemplate extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'risk_level',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(CoachingHistory::class, 'template_id');
    }
}