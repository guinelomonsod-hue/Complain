<?php

use App\Http\Controllers\Api\ComplaintController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class , 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {    
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/fresh', [AuthController::class, 'fresh']);
    Route::get('/complaints' , [ComplaintController::class, 'index']);
    Route::post('/complaints', [ComplaintController::class, 'store']);
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show']);
    Route::patch('/complaints/{complaint}', [ComplaintController::class, 'update']);
});