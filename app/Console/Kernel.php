<?php

namespace App\Console;

use App\Models\ProductView;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $schedule->call(function(){
            Log::info('Đã gửi email');
            $to_name = ['Nguyễn Tấn Cường', 'Lương Quốc Vương'];
            $to_email = ['cuongntph09597@fpt.edu.vn', 'vuongxang@gmail.com'];
            $data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Laravel Test Mail');
                $message->from('phamthu2000vn@gmail.com','Test Mail');
            });
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
