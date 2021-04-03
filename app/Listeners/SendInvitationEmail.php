<?php

namespace App\Listeners;

use App\Events\InvitationCreated;

class SendInvitationEmail
{
    /**
     * Handle the event.
     *
     * @param  InvitationCreated  $event
     * @return void
     */
    public function handle(InvitationCreated $event)
    {
        $event->invitation->sendInvitationEmail();
    }
}
