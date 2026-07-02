<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Challenge;
use App\Models\UserBadge;
use App\Models\User;

class AdminCoachingController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,

            'totalBadges' =>
                Badge::count(),

            'totalChallenges' =>
                Challenge::count(),

            'totalUsers' =>
                User::count(),

            'earnedBadges' =>
                UserBadge::count(),

            'badges' =>
                Badge::all(),

            'challenges' =>
                Challenge::all(),

            'userBadges' =>
                UserBadge::with([
                    'user',
                    'badge'
                ])->get()
        ]);
    }
}