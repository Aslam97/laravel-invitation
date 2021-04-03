<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'event_id', 'email', 'code', 'registered_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
