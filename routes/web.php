<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// ============================================
// User Routes (authenticated)
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class , 'index'])->name('events.index');
    Route::post('/events/{event}/register', [RegistrationController::class , 'store'])->name('events.register');
    Route::delete('/events/{event}/register', [RegistrationController::class , 'destroy'])->name('events.unregister');
});

// ============================================
// Admin Routes (authenticated + admin)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::get('/events/{event}/participants', [AdminEventController::class , 'participants'])->name('events.participants');
});

require __DIR__ . '/settings.php';
