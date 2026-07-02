<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AISetting;

class AdminAIController extends Controller
{
    public function getPrompt()
    {
        return AISetting::where(
            'key',
            'ai_plan_prompt'
        )->first();
    }

    public function savePrompt(Request $request)
    {
        AISetting::updateOrCreate(

            [
                'key' => $request->key
            ],

            [
                'value' => $request->value
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }
}