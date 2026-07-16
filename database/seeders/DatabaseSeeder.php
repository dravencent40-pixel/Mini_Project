<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan firstOrCreate agar tidak crash jika email sudah ada di database
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'walikelas@gmail.com'],
            [
                'name' => 'Wali Kelas X RPL 1',
                'password' => Hash::make('password'),
                'role' => 'wali_kelas',
            ]
        );

        // Untuk data kelas
        ClassModel::firstOrCreate(['name' => 'X RPL 1']);
        ClassModel::firstOrCreate(['name' => 'X RPL 2']);
    }
}