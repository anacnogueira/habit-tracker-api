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

    public function show(Habit $habit)
    {
        return HabitResource::make($habit);
    }

    public function store(StoreHabitRequest $request)
    {
        $data = $request->only(['title','uuid']);
        $data['user_id'] = 1;

        $habit = Habit::create($data);

        return HabitResource::make($habit);

    }
}
