<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function() {
    Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);

    Route::apiResource('habits.logs', HabitLogController::class)
        ->only(['index', 'show', 'store', 'destroy'])
        ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
});
