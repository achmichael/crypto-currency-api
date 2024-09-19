<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan tugas fetch API untuk dijalankan setiap jam
        $schedule->command('fetch:public-api')->hourly();
        $schedule->command('fetch:details')->hourly();
        // Kamu bisa mengubah jadwal sesuai kebutuhan, contoh untuk setiap 5 menit:
        // $schedule->command('fetch:public-api')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
