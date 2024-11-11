<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Auth::routes();

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/confirm-booking', [BookingController::class, 'confirmBooking'])->name('booking.confirmBooking');
    Route::post('/booking/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancelBooking');

    // User dashboard and data storage routes
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard', [UserController::class, 'storeData'])->name('dashboard.submit');
    Route::post('/user/data', [UserController::class, 'storeData'])->name('user.data.store');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Admin Dashboard and management routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/edit/{id}', [AdminDashboardController::class, 'edit'])->name('admin.edit');
    Route::patch('/update/{id}', [AdminDashboardController::class, 'update'])->name('admin.update');
    Route::delete('/delete/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.delete');
    Route::delete('/mass-delete', [AdminDashboardController::class, 'massDelete'])->name('admin.massDelete');
    Route::post('/send-email/{id}/approved', [AdminDashboardController::class, 'sendEmail'])->name('emails.approved');
    Route::post('/send-email/{id}/rejected', [AdminDashboardController::class, 'rejectEmail'])->name('emails.rejected');

    // Admin login routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Booking management routes
    Route::post('/accept-booking/{user_id}', [AdminController::class, 'acceptBooking'])->name('admin.accept-booking');
    Route::post('/reject-booking/{user_id}', [AdminController::class, 'rejectBooking'])->name('admin.reject-booking');
});

// Form and confirmation routes
Route::get('/form', [UserController::class, 'showForm'])->name('form');
Route::post('/confirm', [UserController::class, 'confirm'])->name('confirm');
Route::post('/store', [UserController::class, 'storeData'])->name('storeData');
Route::get('/confirm/result', [UserController::class, 'showResult'])->name('confirm.result');
