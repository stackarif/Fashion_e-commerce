<?php

namespace App\Listeners;

use App\Events\AdminPasswordEvent;
use App\Events\AdminRegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AdminPasswordResetListener
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
    public function handle(AdminPasswordEvent $event)
    {
        if ($event->pass instanceof MustVerifyEmail &&
         !$event->pass->hasVerifiedEmail()) {
            $event->pass->sendEmailVerificationNotification();
        }
    }
}
