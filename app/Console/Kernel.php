<?php

namespace App\Console;

use App\Models\ProductView;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // tự động tăng 1 lượt view cho 1 sản phẩm có id = 50 sau mỗi phút

        $schedule->call(function () {
            Log::info('Schedule Running');
            $today = Carbon::yesterday()->format('Y-m-d');
            $pView = ProductView::where('product_id', 4)
                                ->where('created_at', '>=', $today . " 00:00:00")
                                ->where('created_at', '<=', $today . " 23:59:59")
                                ->first();
            $pView->views += 1;
            $pView->save();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
