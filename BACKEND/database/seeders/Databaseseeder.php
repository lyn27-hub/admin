<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // Admin
        // =====================
        DB::table('admins')->insertOrIgnore([
            'email'      => 'admin@healthify.com',
            'password'   => Hash::make('admin123'),
            'role'       => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =====================
        // Badges
        // =====================
        $badges = [
            ['name' => 'Food Logger', 'category' => 'food_log', 'icon' => '🍽️', 'description' => 'Catat makanan 5 hari berturut-turut', 'condition_type' => 'streak_days', 'condition_value' => 5],
            ['name' => 'Sugar Free', 'category' => 'no_sugar', 'icon' => '🚫🍬', 'description' => 'Tidak konsumsi minuman manis 3 hari', 'condition_type' => 'streak_days', 'condition_value' => 3],
            ['name' => 'Walker', 'category' => 'activity', 'icon' => '🚶', 'description' => 'Jalan kaki 5 hari berturut-turut', 'condition_type' => 'streak_days', 'condition_value' => 5],
            ['name' => 'Weight Watcher', 'category' => 'weight_loss', 'icon' => '⚖️', 'description' => 'Turun berat badan 1 kg', 'condition_type' => 'weight_loss', 'condition_value' => 1],
            ['name' => 'Consistent', 'category' => 'streak', 'icon' => '🔥', 'description' => 'Login 7 hari berturut-turut', 'condition_type' => 'streak_days', 'condition_value' => 7],
            ['name' => 'Healthy Eater', 'category' => 'food_log', 'icon' => '🥗', 'description' => 'Catat makanan 30 hari', 'condition_type' => 'food_log_count', 'condition_value' => 30],
        ];

        foreach ($badges as $badge) {
            DB::table('badges')->insertOrIgnore(array_merge($badge, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // =====================
        // Challenges
        // =====================
        $challenges = [
            ['name' => '7 Hari Tanpa Minuman Manis', 'description' => 'Tantangan tidak konsumsi minuman manis selama 7 hari', 'duration_days' => 7, 'status' => 'active', 'start_date' => now()->startOfMonth(), 'end_date' => now()->startOfMonth()->addDays(7)],
            ['name' => 'Jalan Kaki 5 Hari', 'description' => 'Jalan kaki minimal 20 menit selama 5 hari berturut-turut', 'duration_days' => 5, 'status' => 'active', 'start_date' => now()->startOfMonth(), 'end_date' => now()->startOfMonth()->addDays(5)],
            ['name' => 'Catat Makanan Sebulan', 'description' => 'Catat semua makanan selama 30 hari penuh', 'duration_days' => 30, 'status' => 'active', 'start_date' => now()->startOfMonth(), 'end_date' => now()->endOfMonth()],
        ];

        foreach ($challenges as $challenge) {
            DB::table('challenges')->insertOrIgnore(array_merge($challenge, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // =====================
        // Coaching Templates
        // =====================
        $templates = [
            ['title' => 'Motivasi Pagi', 'content' => 'Selamat pagi! Hari ini adalah kesempatan baru untuk memilih makanan yang lebih sehat. Mulai dengan sarapan bergizi ya!', 'category' => 'motivation', 'risk_level' => 'All', 'is_active' => true],
            ['title' => 'Kurangi Minuman Manis', 'content' => 'Dalam 3 hari terakhir kamu mengonsumsi minuman manis. Coba ganti dengan air putih atau teh tanpa gula hari ini.', 'category' => 'meal', 'risk_level' => 'High', 'is_active' => true],
            ['title' => 'Respon Craving', 'content' => 'Kalau ingin ngemil, coba minum air putih dulu dan tunggu 10 menit. Kalau masih lapar, pilih buah atau yogurt rendah gula.', 'category' => 'craving', 'risk_level' => 'All', 'is_active' => true],
            ['title' => 'Aktivitas Ringan', 'content' => 'Hari ini cukup jalan kaki 15 menit. Tidak harus olahraga berat — yang penting bergerak!', 'category' => 'activity', 'risk_level' => 'Medium', 'is_active' => true],
            ['title' => 'Mindful Eating', 'content' => 'Coba makan lebih pelan hari ini. Kunyah makanan dengan baik dan nikmati setiap suapan. Ini membantu tubuh mengenali rasa kenyang.', 'category' => 'mindful', 'risk_level' => 'All', 'is_active' => true],
            ['title' => 'Evaluasi Mingguan', 'content' => 'Minggu ini kamu sudah mencatat makanan dengan baik. Pertahankan ya! Satu langkah kecil setiap hari membawa perubahan besar.', 'category' => 'motivation', 'risk_level' => 'Low', 'is_active' => true],
        ];

        foreach ($templates as $template) {
            DB::table('coaching_templates')->insertOrIgnore(array_merge($template, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // =====================
        // System Settings
        // =====================
        $settings = [
            ['setting_key' => 'ai_model', 'setting_value' => 'groq/llama3-8b', 'description' => 'Model AI yang digunakan'],
            ['setting_key' => 'bmi_threshold', 'setting_value' => '30', 'description' => 'BMI threshold untuk alert risiko tinggi'],
            ['setting_key' => 'coaching_rule', 'setting_value' => 'Daily', 'description' => 'Frekuensi pengiriman coaching'],
            ['setting_key' => 'wa_connected', 'setting_value' => 'false', 'description' => 'Status koneksi WhatsApp'],
            ['setting_key' => 'alert_sugar_threshold', 'setting_value' => '3', 'description' => 'Jumlah konsumsi gula dalam N hari untuk trigger alert'],
        ];

        foreach ($settings as $setting) {
            DB::table('system_settings')->insertOrIgnore(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}