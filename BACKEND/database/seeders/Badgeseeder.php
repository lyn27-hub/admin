<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name'            => 'Pencatat Setia',
                'category'        => 'food_log',
                'icon'            => '📝',
                'description'     => 'Berhasil mencatat makanan selama 5 hari berturut-turut.',
                'condition_type'  => 'streak_days',
                'condition_value' => 5,
            ],
            [
                'name'            => 'Bebas Gula 3 Hari',
                'category'        => 'no_sugar',
                'icon'            => '🚫🍬',
                'description'     => 'Berhasil mengurangi minuman manis selama 3 hari berturut-turut.',
                'condition_type'  => 'streak_days',
                'condition_value' => 3,
            ],
            [
                'name'            => 'Pejalan Aktif',
                'category'        => 'activity',
                'icon'            => '🚶',
                'description'     => 'Mencatat aktivitas jalan kaki sebanyak 5 kali.',
                'condition_type'  => 'activity_count',
                'condition_value' => 5,
            ],
            [
                'name'            => 'Turun 1 Kg',
                'category'        => 'weight_loss',
                'icon'            => '⚖️',
                'description'     => 'Berhasil menurunkan berat badan sebesar 1 kg dari target awal.',
                'condition_type'  => 'weight_loss',
                'condition_value' => 1,
            ],
            [
                'name'            => 'Konsisten Seminggu',
                'category'        => 'streak',
                'icon'            => '🔥',
                'description'     => 'Aktif menggunakan Healthify selama 7 hari berturut-turut.',
                'condition_type'  => 'streak_days',
                'condition_value' => 7,
            ],
            [
                'name'            => 'Log Pertama',
                'category'        => 'food_log',
                'icon'            => '🌟',
                'description'     => 'Mencatat makanan untuk pertama kalinya.',
                'condition_type'  => 'food_log_count',
                'condition_value' => 1,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(['name' => $badge['name']], $badge);
        }
    }
}