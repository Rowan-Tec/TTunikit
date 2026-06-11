<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WilApplicationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Pages;
use App\Http\Controllers\CallRequestController;



Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

// WIL

Route::get('/wil', function(){ return view('pages.wil');})->name('wil');

Route::post('/wil_application',[WilApplicationController::class, 'store']);


// payfast

Route::middleware('auth')->group(function () {

    Route::post('/payment/{application}', [PaymentController::class, 'pay'])
        ->name('payment.pay');

    Route::get('/payment/success', [PaymentController::class, 'success'])
        ->name('payment.success');

    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])
        ->name('payment.cancel');
});

Route::post('/payfast/notify', [PaymentController::class, 'notify'])
    ->name('payment.notify');

Route::delete('/notifications/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->delete();

    return back();
})->name('notifications.delete');

// Student routes
Route::middleware(['auth', 'customer'])->prefix('dashboard')->group(function () {

  Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
  Route::get('/payment/{id}', [StudentController::class, 'payment'])->name('payment');

Route::get('/status_track',[StudentController::class, 'status'] )->name('status_track');


});



Route::get('/wil_info',[ StudentController::class, 'info'])->name('wil_info');

// Show the application form
Route::get('/wil_application', [WilApplicationController::class, 'create'])
    ->name('wil_application');

    // Save the application
Route::post('/wil_application', [WilApplicationController::class, 'store'])
    ->name('wil_application.store');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('admin.notifications.read');
    Route::get('/application/{id}/document_review',
     [AdminDashboardController::class, 'review'])->name('document_review');
     Route::get(
    '/application/{id}/edit_application',
    [AdminDashboardController::class, 'edit']
)->name('edit_application');

    Route::put(
    '/application/{id}',
    [AdminDashboardController::class, 'update']
)->name('update');

Route::delete(
    '/application/{id}',
    [AdminDashboardController::class, 'destroy']
)->name('destroy');

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
