<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'setting_key'   => 'app_name',
                'setting_value' => 'Healthify',
                'description'   => 'Nama aplikasi yang ditampilkan ke pengguna.',
            ],
            [
                'setting_key'   => 'daily_calorie_default',
                'setting_value' => '1800',
                'description'   => 'Target kalori harian default sebelum profil user diisi (kkal).',
            ],
            [
                'setting_key'   => 'reminder_time_default',
                'setting_value' => '07:00',
                'description'   => 'Jam default pengiriman reminder coaching harian.',
            ],
            [
                'setting_key'   => 'weekly_report_day',
                'setting_value' => 'Monday',
                'description'   => 'Hari pengiriman laporan mingguan otomatis ke user.',
            ],
            [
                'setting_key'   => 'bmi_obesity_threshold',
                'setting_value' => '30',
                'description'   => 'Nilai BMI minimum yang dianggap obesitas dan memicu risk alert.',
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::firstOrCreate(
                ['setting_key' => $setting['setting_key']],
                $setting
            );
        }
    }
}