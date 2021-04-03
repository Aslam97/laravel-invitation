<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Get all events
     *
     * @return \App\Http\Resources\EventResource
     */
    public function index()
    {
        $events = Event::all();

        return EventResource::collection($events);
    }

    /**
     * Show specific event by id
     *
     * @param  string $id
     * @return \App\Http\Resources\EventResource
     */
    public function show($id)
    {
        $event = Event::withCount('invitations as total_invitations')->with('invitations')->firstOrFail($id);

        return new EventResource($event);
    }
}
