<?php

namespace App;

use App\Event;
use App\Notifications\SendEmailJoined;
use App\Notifications\SendInvitationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use Notifiable;

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'code',
        'bod',
        'gender',
        'favorite_designer',
        'registration_code',
        'registered_at',
    ];

    protected $casts = [
        'favorite_designer' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function SendInvitationEmail()
    {
        $this->notify(new SendInvitationEmail());
    }

    public function SendEmailJoined()
    {
        $when = now()->addMinutes(5);
        $this->notify((new SendEmailJoined())->delay($when));
    }
}
