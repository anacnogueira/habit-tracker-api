<?php

namespace App\Policies;

use App\Models\Habit;
use App\Models\User;

class HabitPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function own(User $user, Habit $habit): bool
    {
        return $user->id === $habit->user_id;
    }
}
