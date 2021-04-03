<?php

namespace App;

use App\Event;
use App\Notifications\SendInvitationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use Notifiable;

    protected $fillable = [
        'event_id', 'email', 'code', 'registered_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function SendInvitationEmail()
    {
        $this->notify(new SendInvitationEmail());
    }
}
