<?php

namespace App\Listeners;

use App\Events\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeMailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WelcomeMail  $event
     * @return void
     */
    public function handle(WelcomeMail $event)
    {
        $user = $event->users->toArray();
        Mail::send('email.welcome-email', $user, function($message) use ($user) {
            $message->from('good-job@demos-project.biz');
            $message->subject('Welcome');
            $message->to($user['email']);
        });

    }
}
