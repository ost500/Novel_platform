<?php

namespace App\Console;

use App\Novel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//         $schedule->command('inspire')
//                  ->hourly();
        $schedule->call(function () {
            //fetch the data which are publish_reservation column is not null
            $reservations = Novel::where('publish_reservation', '!=', null)->get();


            foreach ($reservations as $reservation) {
                //make it Datetime Class instance
                $theDate = new Datetime($reservation->publish_reservation);
                //check it is passed or not
                if ($theDate < Carbon::now()) {
                    //if it is passed then make it null
                    $reservation->publish_reservation = null;
                    $reservation->save();
                }
            }
        })->everyMinute();

        $schedule->call(function () {
            foreach (Novel::get() as $novel) {
                $novel->today_count = 0;
                $novel->save();
            }
        })->daily();

        $schedule->call(function () {
            foreach (Novel::get() as $novel) {
                $novel->week_count = 0;
                $novel->save();
            }
        })->weekly();

        $schedule->call(function () {
            foreach (Novel::get() as $novel) {
                $novel->month_count = 0;
                $novel->save();
            }
        })->monthly();

        $schedule->call(function () {
            foreach (Novel::get() as $novel) {
                $novel->year_count = 0;
                $novel->save();
            }
        })->yearly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
