<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Signup routes
Route::get('/signup', [UserController::class, 'showForm'])->name('signup.form');
Route::post('/signup', [UserController::class, 'register'])->name('signup.submit');

// Email verification link
Route::get('/user/verify/{token}', [UserController::class, 'verify'])->name('user.verify');

// Public movie pages
Route::get('/movies', [App\Http\Controllers\MoviePageController::class, 'index'])->name('movies.listing');
Route::get('/movies/search', [App\Http\Controllers\MoviePageController::class, 'search'])->name('movies.search');
Route::get('/movies/{movie}', [App\Http\Controllers\MoviePageController::class, 'show'])->name('movies.show');
Route::middleware('auth')->group(function () {
    Route::get('/movies/{movie}/review', [App\Http\Controllers\MoviePageController::class, 'createReview'])->name('reviews.create');
    Route::post('/movies/{movie}/review', [App\Http\Controllers\MoviePageController::class, 'storeReview'])->name('reviews.store');
});

// User dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

// Admin dashboard routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    // Movies CRUD - moved to /admin/movies to avoid conflict with public /movies
    Route::resource('admin/movies', App\Http\Controllers\MovieController::class)->except(['show']);
    // Reviews deletion
    Route::delete('reviews/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Legacy home route
Route::get('/home', function () {
    return view('home');
})->name('home');

