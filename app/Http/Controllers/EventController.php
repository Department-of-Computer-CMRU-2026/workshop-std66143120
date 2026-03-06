<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display event listing for users with remaining seats and registration status.
     */
    public function index()
    {
        $user = auth()->user();

        $events = Event::withCount('registrations')->latest()->get();

        // Get IDs of events the current user has registered for
        $registeredEventIds = $user->registrations()->pluck('event_id')->toArray();

        // Count how many events the user has registered for
        $userRegistrationCount = count($registeredEventIds);

        return view('events.index', compact('events', 'registeredEventIds', 'userRegistrationCount'));
    }
}
