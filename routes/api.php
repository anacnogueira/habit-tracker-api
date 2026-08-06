<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function() {
    Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);
    Route::get('habits/{habit:uuid}/logs',[HabitLogController::class,'index'])->name('habits.logs.index');
    Route::post('habits/{habit:uuid}/logs',[HabitLogController::class,'store'])->name('habits.logs.store');
});
