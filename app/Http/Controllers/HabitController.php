<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
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

    public function update(Habit $habit, UpdateHabitRequest $request)
    {
        $data = $request->validated();

        $habit->update($data);

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        HabitLog::whereHabitId($habit->id)->delete();

        $habit->delete();

        return response()->noContent();
    }
}
