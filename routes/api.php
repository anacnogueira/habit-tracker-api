<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
Route::name('api.')->group(function() {

    // Guest
    Route::middleware('guest')->group(function() {
        Route::post('/register', [AuthController::class, 'register']);
    });

    //Authentication
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);

        Route::apiResource('habits.logs', HabitLogController::class)
            ->only(['index', 'show', 'store', 'destroy'])
            ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
    });
});
