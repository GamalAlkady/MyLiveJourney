<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TypeController;


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('tours', [TourController::class, 'index'])->name('tours.index');
Route::get('tours/show/{tour}', [TourController::class, 'show'])->name('tours.show');

Route::get('places', [PlaceController::class, 'index'])->name('places.index');
Route::get('places/show/{place}', [PlaceController::class, 'show'])->name('places.show');

Route::get('districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('placetypes', [TypeController::class, 'index'])->name('placetypes.index');

Route::get('booking-request', [BookingController::class, 'index'])->name('booking.index');
Route::post('booking-request', [BookingController::class, 'store'])->name('booking.store');
// عرض الجولات السابقة والحالية
Route::get('tour-history/list', [BookingController::class, 'tourHistory'])->name('tour.history');
Route::get('booking-request/list', [BookingController::class, 'pendingBookingList'])->name('pending.booking');

// إلغاء الحجز
Route::post('booking-request/cancel/{id}', [BookingController::class, 'cancelBookingRequest'])->name('booking.cancel');
