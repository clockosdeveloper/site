<?php

namespace App\Console;

use Clockos\WeeklyStatistics;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Config;
use Illuminate\Support\Facades\Redis;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->call(function(){

            $jsonData = json_decode(file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDCNY%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback='));
            $rate = $jsonData->query->results->rate->Rate;

            Redis::set('exchange_rate_usd_cny', $rate);

            Redis::expire('exchange_rate_usd_cny',12000);

        })->hourly();

        $schedule->call(function(){

            WeeklyStatistics::record();

        })->weekly()->mondays()->at('04:30');

        $schedule->call(function(){

            WeeklyStatistics::record();

        })->everyMinute();
    }
}
