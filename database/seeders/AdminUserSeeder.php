<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ut-posyandu.test'],
            [
                'name' => 'Admin United Tractors',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'posyandu_id' => null,
            ]
        );
    }
}
