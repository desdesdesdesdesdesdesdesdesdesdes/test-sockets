<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\BackendAccess;

Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', BackendAccess::class])->name('dashboard');

Route::middleware(['auth', BackendAccess::class])->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::get('/notifications/create', [NotificationsController::class, 'create'])->name('notifications.create');
    Route::post('/notifications/create', [NotificationsController::class, 'store'])->name('notifications.store');
    Route::get('/notifications/edit/{id}', [NotificationsController::class, 'edit'])->name('notifications.edit');
    Route::patch('/notifications/edit/{id}', [NotificationsController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/delete/{id}', [NotificationsController::class, 'delete'])->name('notifications.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/viewed/{id}', [NotificationsController::class, 'viewed'])->name('notifications.viewed');
});

require __DIR__.'/auth.php';
