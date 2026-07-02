<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WeeklyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'focus',
        'activity_target',
        'small_habit',
        'menu_recommendation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}