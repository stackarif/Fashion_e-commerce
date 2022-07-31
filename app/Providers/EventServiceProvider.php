<?php

namespace App\Providers;

use App\Events\AdminPasswordEvent;
use App\Events\AdminRegisterEvent;
use App\Events\CustomerRegisterEvent;
use App\Listeners\AdminPasswordResetListener;
use App\Listeners\AdminRegisterListener;
use App\Listeners\CustomerRegisterListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AdminRegisterEvent::class=>[
            AdminRegisterListener::class
        ],
        AdminPasswordEvent::class=>[
            AdminPasswordResetListener::class
        ],

        CustomerRegisterEvent::class=>[
            CustomerRegisterListener::class
        ],
    
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
