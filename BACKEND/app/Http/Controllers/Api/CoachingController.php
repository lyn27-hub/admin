<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoachingTemplate;
use App\Models\CoachingHistory;
use App\Models\Screening;

class CoachingController extends Controller
{
    public function daily(int $user_id)
    {
        $screening = Screening::where('user_id',$user_id)
            ->latest()
            ->first();

        $risk = $screening->risk_level;

        $template = CoachingTemplate::where(
                'risk_level',
                $risk
            )
            ->inRandomOrder()
            ->first();

        if (!$template) {

            $template = CoachingTemplate::inRandomOrder()->first();

        }

        CoachingHistory::create([
            'user_id'=>$user_id,
            'template_id'=>$template->id,
            'read_at'=>now()
        ]);

        return response()->json([
            'success'=>true,
            'data'=>$template
        ]);
    }

    public function history(int $user_id)
    {
        $history = CoachingHistory::with('template')
            ->where('user_id',$user_id)
            ->latest()
            ->get();

        return response()->json([
            'success'=>true,
            'data'=>$history
        ]);
    }
}