<?php

namespace App;

use App\Invitation;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'expired_at',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
