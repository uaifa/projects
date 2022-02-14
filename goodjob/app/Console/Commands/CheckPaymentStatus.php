<?php

namespace App\Console\Commands;

use App\Mail\Payment\CheckPaymentStatus as PaymentCheckPaymentStatus;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:check_payment_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Cron is working fine!");

      
        $users = User::all();
        foreach ($users as $user) {
   
            if(!is_null($user->package_start_date_time)){

                $date = date('Y-m-d', strtotime($user->package_start_date_time));
                $current_date = new DateTime();
                $current_date = $current_date->format('Y-m-d');

                $date = new DateTime($date);
                $expire_date = $date->add(new DateInterval('P7D'));
                $expire_date = $expire_date->format('Y-m-d');
                if(strtotime($expire_date) > strtotime($current_date)){
                    Mail::to($user->email)->send(new PaymentCheckPaymentStatus($user));
                }
            }

            // Mail::to($user->email)->send(new PaymentCheckPaymentStatus($user));
        }
         
        $this->info('Word of the Day sent to All Users');
        
        return 0;
    }
}
