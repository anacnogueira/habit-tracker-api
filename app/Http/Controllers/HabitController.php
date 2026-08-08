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
        $habits = Habit::query()
            ->when(request()->string('with', '')->contains('user'),
                fn($query) => $query->with(['user'])
            )
            ->when(request()->string('with', '')->contains('logs'),
                fn($query) => $query->with(['logs'])
            )
            ->simplePaginate();
        return HabitResource::collection($habits);
    }

    public function show(Habit $habit)
    {
        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i']
        ]);

        $load = request()
            ->string('with')
            ->explode(',')
            ->filter(fn ($w) => strlen($w) > 0)
            ->toArray();

        return HabitResource::make(
            $habit->load($load)
        );
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = Habit::create(array_merge($request->validated(), ['user_id' => 1]));

        return HabitResource::make($habit);
    }

    public function update(Habit $habit, UpdateHabitRequest $request)
    {
        $habit->update( $request->validated());

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        $habit->logs()->delete();

        $habit->delete();

        return response()->noContent();
    }
}
