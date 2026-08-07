<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function() {

    // Guest
    Route::middleware('guest')->group(function() {
        Route::post('/register', [AuthController::class, 'register']);
    });

    //Authentication
    Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);

    Route::apiResource('habits.logs', HabitLogController::class)
        ->only(['index', 'show', 'store', 'destroy'])
        ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
});
