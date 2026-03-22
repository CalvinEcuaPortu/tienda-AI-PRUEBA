<?php

namespace App\Console;

use Illuminate\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        // Commands can be added here...
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
        // Define command schedule...
        //
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}