<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController; // <--- This was missing!
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. DASHBOARD (Stats & Calendar)
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // TECH MANAGEMENT ROUTES
    Route::post('/techs', [App\Http\Controllers\ServiceController::class, 'storeTech'])->name('techs.store');
    Route::patch('/techs/{user}/toggle', [App\Http\Controllers\ServiceController::class, 'toggleTech'])->name('techs.toggle');
    
    // 2. SERVICES (Settings)
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    Route::patch('/services/{service}/toggle', [App\Http\Controllers\ServiceController::class, 'toggle'])->name('services.toggle');

    // Booking History Route
    Route::get('/bookings/history', [App\Http\Controllers\BookingController::class, 'history'])->name('bookings.history');

    // 3. BOOKINGS (Projects & Tech Assign)
    Route::resource('bookings', App\Http\Controllers\BookingController::class);
    Route::patch('/booking/{booking}/assign-tech', [App\Http\Controllers\BookingController::class, 'assignTech'])->name('booking.assign');

    // PROFILE
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/booking/{booking}/complete', [App\Http\Controllers\BookingController::class, 'markAsDone'])->name('booking.complete');
});

require __DIR__.'/auth.php';