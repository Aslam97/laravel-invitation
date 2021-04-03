<?php

namespace App\Listeners;

use App\Events\InvitationJoined;

class SendEmailJoined
{
    /**
     * Handle the event.
     *
     * @param  InvitationJoined  $event
     * @return void
     */
    public function handle(InvitationJoined $event)
    {
        $event->invitation->sendEmailJoined();
    }
}
