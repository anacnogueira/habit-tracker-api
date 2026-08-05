<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;


Route::name('api.')->group(function() {
    Route::get('/', function (Request $request) {
      return ['status' => 'ok'];
    });

    Route::get('/habits',[HabitController::class, 'index'])->name('habits.index');
});
