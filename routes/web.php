<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WilApplicationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Pages;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

// WIL

Route::get('/wil_application',[WilApplicationController::class, 'create'])->name('wil_application');
Route::post('/wil_application',[WilApplicationController::class, 'store']);

Route::get('/payment', [StudentController::class, 'payment'])->name('payment');

// Student routes
Route::middleware(['auth', 'customer'])->prefix('dashboard')->group(function () {

  Route::get('/wil_info',[ StudentController::class, 'info'])->name('wil_info');


});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('admin.notifications.read');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/{slug}', [Pages::class, 'index'])->name('pages');
