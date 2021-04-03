<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class InvitationCreated
{
    use SerializesModels;

    /**
     * The invitation.
     *
     * @var string
     */
    public $invitation;

    /**
     * Create a new event instance.
     *
     * @param  \App\Invitation $invitation
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }
}
