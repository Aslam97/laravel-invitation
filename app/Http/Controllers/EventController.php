<?php

namespace App\Http\Controllers;

use App\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::withCount('invitations as total_invitations')->firstOrFail($id);

        return response()->json($event);
    }
}
