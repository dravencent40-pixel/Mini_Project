<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Student\Index as StudentIndex;
use App\Livewire\Attendance\Form as AttendanceForm;
use App\Livewire\Attendance\Report as AttendanceReport; // Import Class Report Baru
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/students', StudentIndex::class)->name('students.index');

    // Route Absensi & Laporan
    Route::get('/attendances/input', AttendanceForm::class)->name('attendances.index');
    Route::get('/attendances/report', AttendanceReport::class)->name('attendances.report');
});