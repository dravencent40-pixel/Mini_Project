<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Student\Index as StudentIndex;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Attendance\Form as AttendanceForm;

Route::middleware('auth')->group(function () {
    Route::get('/attendances/input', AttendanceForm::class)->name('attendances.input');
});

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

    Route::get('/students', StudentIndex::class)->name('students.index');

    Route::middleware(['auth'])->group(function () {
        // Arahkan /dashboard langsung ke Class Livewire Dashboard
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        // Route lainnya...
        Route::get('/attendances/input', \App\Livewire\Attendance\Form::class)->name('attendances.input');
    });
});