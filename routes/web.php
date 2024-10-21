<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// Admin routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit/{id}', [AdminDashboardController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/update/{id}', [AdminDashboardController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.delete');
Route::delete('/admin/mass-delete', [AdminDashboardController::class, 'massDelete'])->name('admin.massDelete');

// Admin login routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// User routes
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/dashboard', [UserController::class, 'storeData'])->middleware('auth')->name('dashboard.submit');
Route::post('/user/data', [UserController::class, 'storeData'])->name('user.data.store')->middleware('auth');

Route::get('/form', [UserController::class, 'showForm'])->name('home');

Route::post('/confirm', [UserController::class, 'confirm'])->name('confirm');

Route::post('/store', [UserController::class, 'storeData'])->name('storeData');

Route::get('/confirm/result', [UserController::class, 'showResult'])->name('confirm.result');
