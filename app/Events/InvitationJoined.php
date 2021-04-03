<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvitationJoined
{
    use Dispatchable, SerializesModels;

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
