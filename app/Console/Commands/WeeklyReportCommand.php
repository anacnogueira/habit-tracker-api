<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('report:weekly')]
#[Description('Send weekly report to the user')]
class WeeklyReportCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'Send weekly report to the user';
    }
}
