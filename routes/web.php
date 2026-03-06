<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// 1. เปลี่ยนหน้าแรกให้ Redirect ไปที่รายการ Event ทันที
Route::get('/', function () {
    return redirect()->route('events.index');
})->name('home');

// 2. Route สำหรับ Dashboard มาตรฐาน (ถ้ายังมีไฟล์ dashboard.blade.php เดิมอยู่)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// ============================================
// User Routes (ต้อง Login ก่อนถึงจะเข้าได้)
// ============================================
Route::middleware(['auth'])->group(function () {
    // หน้ารายการกิจกรรม
    Route::get('/events', [EventController::class , 'index'])->name('events.index');

    // จัดการการลงทะเบียน
    Route::post('/events/{event}/register', [RegistrationController::class , 'store'])->name('events.register');
    Route::delete('/events/{event}/register', [RegistrationController::class , 'destroy'])->name('events.unregister');
});

// ============================================
// Admin Routes (ต้อง Login + เป็น Admin เท่านั้น)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // หน้าสรุปภาพรวม Admin
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');

    // CRUD กิจกรรม (สร้าง/แก้/ลบ)
    Route::resource('events', AdminEventController::class);

    // ดูรายชื่อคนลงทะเบียนในกิจกรรมนั้นๆ
    Route::get('/events/{event}/participants', [AdminEventController::class , 'participants'])->name('events.participants');
});

require __DIR__ . '/settings.php';