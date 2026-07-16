<?php

use App\Livewire\Dashboard;
use App\Livewire\Students\Index as StudentIndex;
use App\Livewire\Classrooms\Index as ClassroomIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('/students', StudentIndex::class)
        ->name('students.index');

    Route::get('/classrooms', ClassroomIndex::class)
        ->name('classrooms.index');

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
