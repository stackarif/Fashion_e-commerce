<?php

namespace App\Listeners;

use App\Events\AdminRegisterEvent;
use App\Events\CustomerRegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class CustomerRegisterListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerRegisterEvent $event)
    {
        if ($event->customer instanceof MustVerifyEmail &&
         !$event->customer->hasVerifiedEmail()) {
            $event->customer->sendEmailVerificationNotification();
        }
    }
}
