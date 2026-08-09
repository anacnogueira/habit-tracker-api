<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Notifications\WeeklyReport;

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
        $user->notify(new WeeklyReport);
    }
}
