<?php

namespace App\Mail\Payment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckPaymentStatus extends Mailable
{
    use Queueable, SerializesModels;


    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        
        return $this->from('good-job@demos-project.biz', 'Subscription Expired')->subject('Subscription Expired')
        ->view('email.expired-subscription-notification', compact('user'));


    }
}
