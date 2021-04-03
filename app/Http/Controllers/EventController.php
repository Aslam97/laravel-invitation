<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return EventResource::collection($events);
    }

    public function show($id)
    {
        $event = Event::withCount('invitations as total_invitations')->firstOrFail($id);

        return new EventResource($event);
    }
}
