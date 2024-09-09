<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Admin routes with middleware protection

// routes/web.php

Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit/{id}', [App\Http\Controllers\AdminDashboardController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/update/{id}', [App\Http\Controllers\AdminDashboardController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [App\Http\Controllers\AdminDashboardController::class, 'destroy'])->name('admin.delete');


// Admin login routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
// User routes
// routes/web.php

Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login.post');

Route::post('/login', 'UserController@login')->middleware('auth');

// routes/web.php

Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard')->middleware('user');

// routes/web.php

Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard')->middleware('can:user.dashboard');

// Authentication routes
Auth::routes();

// Home route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
