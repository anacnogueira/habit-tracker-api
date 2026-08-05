<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Models\Habit;
use App\Http\Resources\HabitResource;

class HabitController extends Controller
{
    public function index()
    {
        return HabitResource::collection(Habit::all());
    }


    public function store(StoreHabitRequest $request)
    {
        $data = $request->validate();

        $habit = Habit::create($data);

        return HabitResource::make($habit);

    }
}
