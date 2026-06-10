<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallRequestController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// In routes/api.php (for the landing page form)
Route::post('/call-request', [CallRequestController::class, 'store']);


