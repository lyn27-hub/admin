<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@healthify.id'],
            [
                'name'     => 'Admin Healthify',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );
    }
}