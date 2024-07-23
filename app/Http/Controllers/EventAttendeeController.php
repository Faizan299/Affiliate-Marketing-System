<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EventAttendee;
use App\Models\User;
use App\Models\Event;

class EventAttendeeController extends Controller
{
    public function index() {
        $eventAttendees = EventAttendee::all();
        $events = Event::all();
        $users = User::all();

        return view('eventAttendees.index', compact('eventAttendees', 'events', 'users'));
    }

    public function eventsList(Request $request)
    {
        // Retrieve the event ID from the request
        $eventId = $request->input('eventId');

        // Fetch event attendees from the database based on the event ID
        $attendees = EventAttendee::where('event_id', $eventId)->get();

        // Fetch user details for each attendee
        $attendeeDetails = [];
        foreach ($attendees as $attendee) {
            // Fetch user details for the student ID
            $user = User::find($attendee->student_id);

            // Add user details to the attendee details array
            if ($user) {
                $attendeeDetails[] = [
                    'id' => $attendee->id,
                    'event_id' => $attendee->event_id,
                    'student_id' => $attendee->student_id,
                    'user' => $user // Add user details
                ];
            }
        }

        // Return the attendee details as JSON response
        return response()->json($attendeeDetails);
    }
}
