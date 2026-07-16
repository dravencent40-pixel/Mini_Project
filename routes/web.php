<?php

use App\Livewire\Auth\Login;
use App\Livewire\Student\Index as StudentIndex;
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

    Route::get('/students', StudentIndex::class)->name('students.index');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});