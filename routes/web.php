<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WilApplicationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Pages;
use App\Http\Controllers\CallRequestController;

// Welcome
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Public WIL info page
Route::get('/wil', function () {
    return view('pages.wil');
})->name('wil');

// Dashboard - role-based redirect
Route::get('/dashboard', function () {
    return match(auth()->user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'student'  => redirect()->route('student.dashboard'),
        'customer' => redirect()->route('wil_application'),
        default    => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// PayFast notify (no auth - called by PayFast server)
Route::post('/payfast/notify', [PaymentController::class, 'notify'])
    ->name('payment.notify');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::delete('/notifications/{id}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return back();
    })->name('notifications.delete');

    // Payment
    Route::post('/payment/{application}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Customer routes (wil application only)
Route::middleware(['auth', 'customer'])->prefix('dashboard')->group(function () {
    Route::get('/wil_application', [WilApplicationController::class, 'create'])->name('wil_application');
    Route::post('/wil_application', [WilApplicationController::class, 'store'])->name('wil_application.store');
});

Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

// Student routes
Route::middleware(['auth', 'student'])->prefix('dashboard')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/payment/{id}', [StudentController::class, 'payment'])->name('payment');
    Route::get('/status_track', [StudentController::class, 'status'])->name('status_track');
    Route::get('/wil_info', [StudentController::class, 'info'])->name('wil_info');
});

// Public - anyone can submit
Route::post('/call-request', [CallRequestController::class, 'store'])
    ->name('call_request.store');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('admin.notifications.read');
    Route::get('/application/{id}/document_review', [AdminDashboardController::class, 'review'])->name('document_review');
    Route::get('/application/{id}/edit_application', [AdminDashboardController::class, 'edit'])->name('edit_application');
    Route::put('/application/{id}', [AdminDashboardController::class, 'update'])->name('update');
    Route::delete('/application/{id}', [AdminDashboardController::class, 'destroy'])->name('destroy');

    Route::patch('/call-request/{id}/complete', [CallRequestController::class, 'complete'])
        ->name('call_request.complete');
    Route::delete('/call-request/{id}', [CallRequestController::class, 'destroy'])
        ->name('call_request.destroy');
});

require __DIR__.'/auth.php';

// Catch-all (must be last)
Route::get('/{slug}', [Pages::class, 'index'])->name('pages');