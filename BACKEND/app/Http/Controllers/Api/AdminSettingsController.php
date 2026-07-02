<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use App\Models\User;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::all();

        return response()->json([
            'success' => true,
            'totalUsers' => User::count(),
            'settings' => $settings
        ]);
    }
}