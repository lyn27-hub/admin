<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RiskAlert;

class RiskAlertController extends Controller
{
    public function index()
    {
        $alerts = RiskAlert::with('user')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $alerts,
        ]);
    }

    public function statistics()
    {
        return response()->json([
            'active_alerts' => RiskAlert::where('status', 'Aktif')->count(),
            'high_risk' => RiskAlert::where('severity', 'High')->count(),
            'need_review' => RiskAlert::where('status', 'Review')->count(),
            'medical_flags' => RiskAlert::count(),
        ]);
    }
}