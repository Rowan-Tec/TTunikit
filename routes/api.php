<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallRequestController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// In routes/api.php (for the landing page form)
Route::post('/call-request', [CallRequestController::class, 'store']);

// In routes/web.php (for the admin dashboard)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/call-requests', [CallRequestController::class, 'index'])->name('call-requests.index');
    Route::patch('/call-requests/{callRequest}/mark-called', [CallRequestController::class, 'markAsCalled'])->name('call-requests.mark-called');
});