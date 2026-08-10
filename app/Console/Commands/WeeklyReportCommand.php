<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('report:weekly')]
#[Description('Send weekly report to the user')]
class WeeklyReportCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::first();
        $query = "WITH RECURSIVE calendar AS (
            SELECT DATE_SUB(CURRENT_DATE(), INTERVAL WEEKDAY(CURRENT_DATE()) DAY) AS log_date
            UNION ALL
            SELECT DATE_ADD(log_date, INTERVAL 1 DAY)
            FROM calendar
            WHERE DATE_ADD(log_date, INTERVAL 1 DAY) <= DATE_ADD(DATE_SUB(CURRENT_DATE(), INTERVAL WEEKDAY(CURRENT_DATE()) DAY), INTERVAL 6 DAY)
        )
        SELECT
            h.id AS habit_id,
            h.title AS habit_name,
            c.log_date,
            CASE WHEN hl.id IS NOT NULL THEN 1 ELSE 0 END AS completed
        FROM calendar c
        CROSS JOIN habits h
        LEFT JOIN habit_logs hl
            ON DATE(hl.completed_at) = c.log_date
        AND hl.habit_id = h.id
        JOIN users u
            ON h.user_id = u.id
        WHERE u.id = ?
        ORDER BY h.id, c.log_date";

        $habits = collect(DB::select($query, [$user->id]))
            ->map(function($habit){
                return (object) [
                    'habit_id' => $habit->habit_id,
                    'habit_name' => $habit->habit_name,
                    'log_date' => Carbon::make($habit->log_date),
                    'completed' => (bool) $habit->completed
                ];
            });

        $user->notify(new WeeklyReport($habits));
    }
}
