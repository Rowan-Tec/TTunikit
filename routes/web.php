<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginActivityController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AccountDeletionController;
use App\Http\Controllers\ProfilePhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

use App\Http\Controllers\UserManagementController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Profile API Routes
    Route::get('/api/profile', [ProfileController::class, 'getProfile'])->name('profile.get');
    Route::post('/api/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update.ajax');
    Route::post('/api/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.email.update');
    Route::get('/api/profile/export', [ProfileController::class, 'exportData'])->name('profile.export');

    // Password Management Routes
    Route::get('/profile/change-password', [PasswordController::class, 'showChangeForm'])->name('password.change.form');
    Route::post('/profile/change-password', [PasswordController::class, 'change'])->name('password.change');

    // Account Deletion Routes
    Route::get('/profile/delete-account', [AccountDeletionController::class, 'showDeletionForm'])->name('account.delete.form');
    Route::post('/profile/delete-account', [AccountDeletionController::class, 'delete'])->name('account.delete');
    Route::post('/api/account/request-deletion', [AccountDeletionController::class, 'requestDeletion'])->name('account.request-deletion');
    Route::post('/api/account/cancel-deletion', [AccountDeletionController::class, 'cancelDeletion'])->name('account.cancel-deletion');

    // Profile Photo Routes
    Route::get('/profile/photo', [ProfilePhotoController::class, 'getPhoto'])->name('profile.photo.get');
    Route::post('/profile/photo/upload', [ProfilePhotoController::class, 'upload'])->name('profile.photo.upload');
    Route::post('/profile/photo/crop', [ProfilePhotoController::class, 'crop'])->name('profile.photo.crop');
    Route::post('/profile/photo/delete', [ProfilePhotoController::class, 'delete'])->name('profile.photo.delete');
    Route::post('/profile/photo/set-default', [ProfilePhotoController::class, 'setDefault'])->name('profile.photo.set-default');

    // Login Activity Routes
    Route::get('/profile/login-activity', [LoginActivityController::class, 'index'])->name('login-activity.index');
    Route::get('/api/login-activity/statistics', [LoginActivityController::class, 'statistics'])->name('login-activity.statistics');
    Route::post('/api/login-activity/export', [LoginActivityController::class, 'export'])->name('login-activity.export');
    Route::post('/api/login-activity/clear', [LoginActivityController::class, 'clear'])->name('login-activity.clear');

    // Admin routes
    Route::middleware('can:admin-only')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    });
});

Route::get('/{slug}', [Pages::class, 'index'])->name('pages');

