<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\FoodLogController;
use App\Http\Controllers\Api\ScreeningController;
use App\Http\Controllers\Api\LeaderboardController;
use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\CoachingController;
use App\Http\Controllers\Api\WeeklyReportController;
use App\Http\Controllers\Api\WeeklyPlanController;
use App\Http\Controllers\Api\TestGeminiController;
use App\Http\Controllers\Api\TestDeepSeekController;
use App\Http\Controllers\Api\TestGroqController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RiskAlertController;
use App\Http\Controllers\Api\AdminCoachingController;
use App\Http\Controllers\Api\AdminAchievementController;
use App\Http\Controllers\Api\AdminSettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAIController;

// =========================
// PUBLIC — User App
// =========================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user/{id}/upload-profile-picture', [AuthController::class, 'updateProfilePicture']);
Route::put('/user/{id}', [AuthController::class, 'update']);

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/search', [FoodLogController::class, 'searchFood']);

Route::post('/food-logs', [FoodLogController::class, 'store']);
Route::get('/food-logs/today/{user_id}', [FoodLogController::class, 'today']);
Route::post('/food-log/whatsapp', [FoodLogController::class, 'storeFromWhatsApp']);

Route::get('/leaderboard/top', [LeaderboardController::class, 'getTopLeaderboard']);

Route::post('/screening', [ScreeningController::class, 'store']);
Route::get('/screening/latest/{user_id}', [ScreeningController::class, 'latest']);
Route::get('/screening/history/{user_id}', [ScreeningController::class, 'history']);

Route::get('/alerts/{user_id}', [AlertController::class, 'obesityRisk']);

Route::get('/coaching/daily/{user_id}', [CoachingController::class, 'daily']);
Route::get('/coaching/history/{user_id}', [CoachingController::class, 'history']);

Route::get('/weekly-report/{user_id}', [WeeklyReportController::class, 'generate']);
Route::get('/weekly-plan/{user_id}', [WeeklyPlanController::class, 'getPlan']);

// Test routes (bisa dihapus di production)
Route::get('/test-gemini', [TestGeminiController::class, 'test']);
Route::get('/test-deepseek', [TestDeepSeekController::class, 'test']);
Route::get('/test-groq', [TestGroqController::class, 'test']);

// =========================
// PUBLIC — Admin Auth
// =========================
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/forgot-password', [AdminAuthController::class, 'forgotPassword']);
Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPassword']);

// =========================
// PROTECTED — Admin Panel
// =========================
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {

    // Auth
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::get('/me', [AdminAuthController::class, 'me']);

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Users
    Route::get('/users', [UserController::class, 'index']);

    // Foods
    Route::get('/foods', [FoodController::class, 'index']);
    Route::post('/foods', [FoodController::class, 'store']);
    Route::put('/foods/{id}', [FoodController::class, 'update']);
    Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
    Route::get('/food-statistics', [FoodLogController::class, 'adminStatistics']);

    // Weekly Plans
    Route::get('/weekly-plans', [WeeklyPlanController::class, 'getAllPlans']);

    // Risk & Safety
    Route::get('/risk-alerts', [RiskAlertController::class, 'index']);
    Route::get('/risk-statistics', [RiskAlertController::class, 'statistics']);

    // Coaching
    Route::get('/coaching', [AdminCoachingController::class, 'index']);

    // Achievements
    Route::get('/achievements', [AdminAchievementController::class, 'index']);

    // Settings
    Route::get('/settings', [AdminSettingsController::class, 'index']);

    // AI Settings (untuk UI admin, butuh login)
    Route::get('/ai-settings', [AdminAIController::class, 'getPrompt']);
    Route::post('/ai-settings', [AdminAIController::class, 'savePrompt']);
    Route::post('/test-ai', [AdminAIController::class, 'testAI']);
});

// Internal — dipanggil oleh backend USER (server-to-server, pakai API key, bukan token admin)
Route::middleware(['internal.api'])->group(function () {
    Route::get('/internal/ai-settings', [AdminAIController::class, 'getPromptInternal']);
});

// Achievements CRUD
Route::post('/achievements/badges', [AdminAchievementController::class, 'storeBadge']);
Route::put('/achievements/badges/{id}', [AdminAchievementController::class, 'updateBadge']);
Route::delete('/achievements/badges/{id}', [AdminAchievementController::class, 'destroyBadge']);
Route::post('/achievements/challenges', [AdminAchievementController::class, 'storeChallenge']);
Route::put('/achievements/challenges/{id}', [AdminAchievementController::class, 'updateChallenge']);
Route::delete('/achievements/challenges/{id}', [AdminAchievementController::class, 'destroyChallenge']);
