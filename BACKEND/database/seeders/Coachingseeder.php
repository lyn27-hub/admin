<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Challenge;
use Carbon\Carbon;

class ChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $challenges = [
            [
                'name'          => 'Challenge 7 Hari Tanpa Minuman Manis',
                'description'   => 'Hindari minuman manis selama 7 hari penuh. Ganti dengan air putih atau infused water. Hemat hingga 700 kkal per minggu!',
                'duration_days' => 7,
                'status'        => 'active',
                'start_date'    => Carbon::today(),
                'end_date'      => Carbon::today()->addDays(7),
            ],
            [
                'name'          => 'Challenge Jalan Kaki 10 Hari',
                'description'   => 'Jalan kaki minimal 15 menit setiap hari selama 10 hari berturut-turut. Cocok untuk pemula yang baru mulai aktif bergerak.',
                'duration_days' => 10,
                'status'        => 'active',
                'start_date'    => Carbon::today(),
                'end_date'      => Carbon::today()->addDays(10),
            ],
            [
                'name'          => 'Challenge Catat Makanan 5 Hari',
                'description'   => 'Catat semua makanan dan minuman selama 5 hari. Kesadaran pola makan adalah langkah pertama perubahan perilaku.',
                'duration_days' => 5,
                'status'        => 'active',
                'start_date'    => Carbon::today(),
                'end_date'      => Carbon::today()->addDays(5),
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::firstOrCreate(['name' => $challenge['name']], $challenge);
        }
    }
}