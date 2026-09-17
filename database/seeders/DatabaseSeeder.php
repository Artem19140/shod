<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        User::factory()->create([
            'surname' => 'admin',
            'name' => 'admin',
            'patronymic' => 'admin',
            'email' => config('app.admin_credentials.email'),
            'password' => Hash::make(config('app.admin_credentials.password')),
            'udsu_id' => null,
            'is_verified' => true,
            'is_admin' => true
        ]);
    }
}
