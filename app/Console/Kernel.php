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
        Commands\ArchivesImport::class,
        Commands\ArchivesDownload::class,
        \Aic\Hub\Foundation\Commands\DatabaseReset::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('archives:import --quiet')
            ->monthlyOn(1, '01:' . (config('app.env') === 'production' ? '00' : '15'))
            ->before(function () {
                Artisan::call('archives:download', ['--quiet' => 'default']);
            })
            ->sendOutputTo(storage_path('logs/import-last-run.log'));

    }
}
