<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ProducePost::class,
        Commands\ProduceComment::class,
        Commands\ProduceLike::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('schedule:ProducePost')->everyMinute();
        $schedule->command('schedule:ProduceComment')->everyMinute();
        $schedule->command('schedule:ProduceLike')->everyMinute();
    }
}
