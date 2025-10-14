<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// إدارة الجولات الخاصة به
Route::get('running/packages', [BookingController::class, 'runningPackage'])->name('package.running');
Route::post('running/package/complete/{id}', [BookingController::class, 'runningPackageComplete'])->name('package.running.complete');

// إدارة الحجوزات
Route::get('booking-request/list', [BookingController::class, 'pendingBookingList'])->name('pending.booking');
Route::post('booking-request/approve/{id}', [BookingController::class, 'bookingApprove'])->name('booking.approve');

