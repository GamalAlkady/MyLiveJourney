<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersManagementController;
use App\Http\Controllers\SoftDeletesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AdminDetailsController;
use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// إدارة المستخدمين
Route::resource('users', UsersManagementController::class);
Route::resource('deleted-users', SoftDeletesController::class)->names([
    'index'   => 'deleted',
    'show'    => 'deleted.show',
    'update'  => 'deleted.update',
    'destroy' => 'deleted.destroy',
]);

// إدارة الأماكن والجولات
Route::resource('districts', DistrictController::class);
Route::resource('placetypes', TypeController::class);
Route::resource('places', PlaceController::class);
Route::resource('tours', TourController::class);

// إدارة الحجوزات
Route::get('booking-request/list', [BookingController::class, 'pendingBookingList'])->name('pending.booking');
Route::get('tour-history/list', [BookingController::class, 'tourHistory'])->name('tour.history');
Route::post('booking-request/approve/{id}', [BookingController::class, 'bookingApprove'])->name('booking.approve');
Route::post('booking-request/remove/{id}', [BookingController::class, 'bookingRemoveByAdmin'])->name('booking.remove');

Route::get('active-users', [AdminDetailsController::class, 'activeUsers'])->name('active-users');
Route::get('guides', [UsersManagementController::class, 'guideList'])->name('guides');
Route::get('running/packages/', [BookingController::class, 'runningPackage'])->name('package.running');
