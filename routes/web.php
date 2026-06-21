<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Admin\GameManagementController;
use Illuminate\Support\Facades\Route;

// Home Dashboard
Route::get('/', function () {
    $games = \App\Models\Game::withCount('followers')->take(6)->get();
    return view('home.index', compact('games'));
})->name('home');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Game Library Hub
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{slug}', [GameController::class, 'show'])->name('games.show');

// Admin Panel (Games CRUD)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('games', GameManagementController::class)->except(['show']);
});
