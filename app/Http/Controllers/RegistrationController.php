<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Register the authenticated user for an event.
     */
    public function store(Event $event)
    {
        $user = auth()->user();

        // Check if user has already registered for 3 events
        $currentRegistrations = Registration::where('user_id', $user->id)->count();
        if ($currentRegistrations >= 3) {
            return back()->with('error', 'You can register for a maximum of 3 events only.');
        }

        // Check if user has already registered for this event
        $alreadyRegistered = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'You have already registered for this event.');
        }

        // Use database transaction with pessimistic locking for atomic operations
        try {
            DB::transaction(function () use ($event, $user) {
                // Lock the event row to prevent race conditions
                $lockedEvent = Event::lockForUpdate()->find($event->id);

                // Re-check remaining seats inside the transaction
                $registeredCount = Registration::where('event_id', $lockedEvent->id)->count();
                $remainingSeats = $lockedEvent->total_seats - $registeredCount;

                if ($remainingSeats <= 0) {
                    throw new \Exception('This event is fully booked. No seats remaining.');
                }

                // Re-check user registration count inside the transaction
                $userCount = Registration::where('user_id', $user->id)->count();
                if ($userCount >= 3) {
                    throw new \Exception('You can register for a maximum of 3 events only.');
                }

                // Create the registration
                Registration::create([
                    'user_id' => $user->id,
                    'event_id' => $lockedEvent->id,
                ]);
            });

            return back()->with('success', 'Successfully registered for "' . $event->title . '"!');
        }
        catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Cancel the authenticated user's registration for an event.
     */
    public function destroy(Event $event)
    {
        $user = auth()->user();

        $registration = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$registration) {
            return back()->with('error', 'You are not registered for this event.');
        }

        $registration->delete();

        return back()->with('success', 'Registration for "' . $event->title . '" has been cancelled.');
    }
}
