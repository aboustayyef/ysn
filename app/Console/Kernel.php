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
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\getLatestPosts::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('posts:get Youtube 20 طلعت+ريحتكم')->everyFiveMinutes();
        $schedule->command('posts:get Youtube 20 بدنا+نحاسب')->everyFiveMinutes();
        $schedule->command('posts:get Youtube 20 lebanon+youstink')->everyFiveMinutes();
        $schedule->command('posts:get Twitter 20 \#youstink 2')->everyFiveMinutes();
        $schedule->command('posts:get Twitter 20 بدنا_نحاسب 1')->everyFiveMinutes();
        $schedule->command('posts:get Twitter 20 طلعت_ريحتكم 3')->everyFiveMinutes();
        $schedule->command('posts:get LebaneseBlogs 20')->everyFiveMinutes();
        $schedule->command('posts:get Facebook 20')->everyFiveMinutes();
        $schedule->command('posts:get Instagram 20 youstink 20')->everyFiveMinutes();
        $schedule->command('posts:get Instagram 20 طلعتـريحتكم 20')->everyFiveMinutes();
    }
}