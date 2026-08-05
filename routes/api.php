<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::name('api.')->group(function() {
    Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);
});
