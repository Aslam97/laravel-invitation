<?php

namespace App\Providers;

use App\Events\InvitationCreated;
use App\Events\InvitationJoined;
use App\Listeners\SendEmailJoined;
use App\Listeners\SendInvitationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InvitationCreated::class => [
            SendInvitationEmail::class,
        ],
        InvitationJoined::class => [
            SendEmailJoined::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
