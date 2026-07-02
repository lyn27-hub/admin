<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FoodLog;
use App\Models\Screening;

class Screening extends Model
{
    use HasFactory;

protected $table = 'screenings';

protected $fillable = [

    'user_id',
    'weight',
    'height',
    'waist',
    'age',
    'gender',

    'imt_value',
    'imt_classification',

    'risk_level',
    'central_obesity_status',
    'sarc_f_score',
    'sarcopenia_status',

    // AI PLAN
    'weekly_target',
    'activity_target',
    'food_recommendation',
    'habit_recommendation',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}