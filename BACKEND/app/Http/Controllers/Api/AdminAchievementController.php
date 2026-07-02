<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAchievementController extends Controller
{
    public function index()
    {
        $badges = DB::table('badges')->get();
        $challenges = DB::table('challenges')->get();
        $userBadges = DB::table('user_badges')
            ->join('users', 'user_badges.user_id', '=', 'users.id')
            ->join('badges', 'user_badges.badge_id', '=', 'badges.id')
            ->select(
                'user_badges.id',
                'user_badges.user_id',
                'user_badges.badge_id',
                'user_badges.earned_at',
                'users.name as user_name',
                'badges.name as badge_name',
                'badges.category as badge_category',
                'badges.icon as badge_icon',
            )
            ->orderByDesc('user_badges.earned_at')
            ->get()
            ->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'user_id'    => $item->user_id,
                    'badge_id'   => $item->badge_id,
                    'earned_at'  => $item->earned_at,
                    'user'       => ['name' => $item->user_name],
                    'badge'      => [
                        'name'     => $item->badge_name,
                        'category' => $item->badge_category,
                        'icon'     => $item->badge_icon,
                    ],
                ];
            });

        return response()->json([
            'success'        => true,
            'totalBadges'    => $badges->count(),
            'totalChallenges'=> $challenges->count(),
            'earnedBadges'   => $userBadges->count(),
            'totalUsers'     => User::count(),
            'badges'         => $badges,
            'challenges'     => $challenges,
            'userBadges'     => $userBadges,
        ]);
    }

    public function storeBadge(Request $request)
    {
        $request->validate([
            'name'            => 'required|string',
            'category'        => 'required|string',
            'condition_type'  => 'required|string',
            'condition_value' => 'required|integer',
        ]);

        $id = DB::table('badges')->insertGetId([
            'name'            => $request->name,
            'category'        => $request->category,
            'icon'            => $request->icon,
            'description'     => $request->description,
            'condition_type'  => $request->condition_type,
            'condition_value' => $request->condition_value,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id]);
    }

    public function updateBadge(Request $request, $id)
    {
        DB::table('badges')->where('id', $id)->update([
            'name'            => $request->name,
            'category'        => $request->category,
            'icon'            => $request->icon,
            'description'     => $request->description,
            'condition_type'  => $request->condition_type,
            'condition_value' => $request->condition_value,
            'updated_at'      => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroyBadge($id)
    {
        DB::table('badges')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function storeChallenge(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);

        $id = DB::table('challenges')->insertGetId([
            'name'          => $request->name,
            'description'   => $request->description,
            'duration_days' => $request->duration_days ?? 7,
            'status'        => $request->status ?? 'active',
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id]);
    }

    public function updateChallenge(Request $request, $id)
    {
        DB::table('challenges')->where('id', $id)->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'duration_days' => $request->duration_days,
            'status'        => $request->status,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'updated_at'    => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroyChallenge($id)
    {
        DB::table('challenges')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}