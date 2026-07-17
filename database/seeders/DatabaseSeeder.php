<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun User Admin/Guru jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Buat Data Kelas Sample
        $kelas10A = ClassModel::firstOrCreate(['name' => 'X IPA 1']);
        $kelas10B = ClassModel::firstOrCreate(['name' => 'X IPA 2']);

        // 3. Buat Data Siswa Sample di Kelas X IPA 1
        $students10A = [
            ['nisn' => '0012345671', 'name' => 'Ahmad Fauzi', 'gender' => 'L', 'class_id' => $kelas10A->id],
            ['nisn' => '0012345672', 'name' => 'Budi Santoso', 'gender' => 'L', 'class_id' => $kelas10A->id],
            ['nisn' => '0012345673', 'name' => 'Citra Lestari', 'gender' => 'P', 'class_id' => $kelas10A->id],
            ['nisn' => '0012345674', 'name' => 'Dewi Anggraini', 'gender' => 'P', 'class_id' => $kelas10A->id],
            ['nisn' => '0012345675', 'name' => 'Eko Prasetyo', 'gender' => 'L', 'class_id' => $kelas10A->id],
        ];

        foreach ($students10A as $student) {
            Student::firstOrCreate(['nisn' => $student['nisn']], $student);
        }

        // 4. Buat Data Siswa Sample di Kelas X IPA 2
        $students10B = [
            ['nisn' => '0012345676', 'name' => 'Fajar Nugraha', 'gender' => 'L', 'class_id' => $kelas10B->id],
            ['nisn' => '0012345677', 'name' => 'Gita Gutawa', 'gender' => 'P', 'class_id' => $kelas10B->id],
            ['nisn' => '0012345678', 'name' => 'Hendra Setiawan', 'gender' => 'L', 'class_id' => $kelas10B->id],
        ];

        foreach ($students10B as $student) {
            Student::firstOrCreate(['nisn' => $student['nisn']], $student);
        }
    }
}