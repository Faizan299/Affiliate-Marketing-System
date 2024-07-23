<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Event;
use App\Models\Club;
use App\Models\User;
use App\Models\EventAttendee;
use Carbon\Carbon;

use Illuminate\Support\Facades\Notification;
use App\Notifications\EventApproval;
use App\Notifications\LiveEvents;
use App\Notifications\informEvent;

class EventController extends Controller
{
    
    public function view($eventId)
    {
        // Find the event by its ID
        $event = Event::findOrFail($eventId);

        // Get the attendees of the event
        $attendees = $event->attendees()->withPivot('attended_status')->get();

        // Get the currently authenticated user's ID
        $student_id = auth()->id();

        // Check if the authenticated user is an attendee of the event
        $eventAttendees = EventAttendee::where('student_id', $student_id)->where('event_id', $eventId)->exists();

        // Count the total number of attendees for the event
        $attendeeCount = EventAttendee::where('event_id', $eventId)->count();

        // Determine if the event is live
        $currentDateTime = Carbon::now();

        $isLiveEvent = Event::where('id', $eventId)
            ->where(function($query) use ($currentDateTime) {
                $query->whereDate('start_date', '<=', $currentDateTime->toDateString())
                      ->whereDate('end_date', '>=', $currentDateTime->toDateString());
            })
            ->where(function($query) use ($currentDateTime) {
                $query->where(function($query) use ($currentDateTime) {
                    $query->whereDate('start_date', '=', $currentDateTime->toDateString())
                          ->whereTime('start_time', '<=', $currentDateTime->toTimeString())
                          ->whereDate('end_date', '=', $currentDateTime->toDateString())
                          ->whereTime('end_time', '>=', $currentDateTime->toTimeString());
                })
                ->orWhere(function($query) use ($currentDateTime) {
                    $query->whereDate('start_date', '<=', $currentDateTime->toDateString())
                          ->whereDate('end_date', '>=', $currentDateTime->toDateString());
                });
            })
            ->exists();

        // Additional check if the authenticated user is an attendee of the event
        $isUserAttendee = EventAttendee::where('event_id', $eventId)
                                       ->where('student_id', $student_id)
                                       ->exists();
        
        $isAttendee = EventAttendee::where('event_id', $eventId)
                                       ->where('student_id', $student_id)
                                       ->where('attended_status', 1)
                                       ->exists();


        // Pass the data to the view
        return view('events.view', compact('event', 'attendees', 'eventAttendees', 'attendeeCount', 'isLiveEvent', 'isUserAttendee', 'isAttendee'));
    }
    
    public function checkAndNotifyLiveEvents()
    {
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Get events that are going live
        $liveEvents = Event::whereDate('start_date', $currentDate)
            ->whereTime('start_time', '<=', $currentTime)
            ->whereDate('end_date', '>=', $currentDate)
            ->whereTime('end_time', '>=', $currentTime)
            ->get();

        foreach ($liveEvents as $event) {
            // Get all users
            $users = User::all();

            // Send notification to all users
            Notification::send($users, new LiveEvents($event));
            Log::info('Notification sent for event ID: ' . $event->id);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'max:255'],
            'end_date' => ['required', 'date', 'max:255', 'after_or_equal:start_date'],
            'start_time' => ['required', 'string', 'max:255'],
            'end_time' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'club_id' => ['required', 'integer'], 
            'coordinator_id' => ['required', 'integer'], 
            'color' => ['required', 'string'], 
            'description' => ['string', 'max:500'],
            'image' => ['required', 'image', 'max:5048'], 
            'selected_students_1' => ['required', 'string', 'max:255']
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images/event_images'), $newImageName);

        $event = new Event();
        $event->name = $request->name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->club_id =   $request->club_id;
        $event->color = $request->color;
        $event->description = $request->description;
        $event->image = $newImageName;
        $event->status = 0;
        $event->coordinator_id = $request->coordinator_id;
        $event->visible_to = $request->selected_students_1;
        $event->save();

        return redirect()->route('events.add')->with('success', 'Event registered successfully!');
    }


    public function register(Request $request)
    {
        // Get the user ID
        $userId = auth()->id();

        // Get the event ID from the request data
        $eventId = $request->input('eventId');

        // Check if the user is already registered for the event
        $existingRegistration = EventAttendee::where('student_id', $userId)
                                            ->where('event_id', $eventId)
                                            ->exists();

        // If the user is already registered, return an error response
        if ($existingRegistration) {
            return response()->json(['error' => 'User is already registered for this event'], 400);
        }

        // If the user is not already registered, create a new registration entry
        EventAttendee::create([
            'student_id' => $userId,
            'event_id' => $eventId,
            'attended_status' => 0,
        ]);

        // Return a success response with a 201 Created status code
        return response()->json(['success' => 'Registered Successfully!'], 201);
    }

    public function attendance(Request $request)
    {
        // Get the event ID from the request
        $eventId = $request->input('eventId');
        // Get the comma-separated student IDs from the request and convert them into an array
        $studentIds = explode(',', $request->input('selected_students_1'));

        // Check if any of the selected students already have an attended_status of 1
        $alreadyMarked = EventAttendee::where('event_id', $eventId)
            ->whereIn('student_id', $studentIds)
            ->where('attended_status', 1)
            ->exists();

        if ($alreadyMarked) {
            return response()->json(['message' => 'Attendance already marked for one or more students'], 200);
        }

        // Update the `attended_status` to 1 where `event_id` and `student_id` match and status is not already 1
        EventAttendee::where('event_id', $eventId)
            ->whereIn('student_id', $studentIds)
            ->update(['attended_status' => 1]);

        return response()->json(['message' => 'Attendance marked successfully'], 200);
    }



    public function show()
    {
        $userId = auth()->id();

        // Get all events with related club
        $events = Event::with(['club', 'coordinator'])->get();

        // Get events specific to the coordinator
        $specific_events = Event::where('coordinator_id', $userId)->with('club')->get();

        // Create an array of coordinator names for specific events
        $coordinatorNames = $specific_events->map(function($event) {
            return $event->coordinator ? $event->coordinator->name : 'N/A';
        });

        $currentDateTime = Carbon::now();

        // Retrieve live events
        $live_events = Event::whereRaw("FIND_IN_SET(?, visible_to)", [$userId])
            ->where('status', 1)
            ->where(function($query) use ($currentDateTime) {
                $query->where(function($query) use ($currentDateTime) {
                    $query->whereDate('start_date', '<=', $currentDateTime->toDateString())
                        ->whereDate('end_date', '>=', $currentDateTime->toDateString())
                        ->where(function($query) use ($currentDateTime) {
                            $query->whereTime('start_time', '<=', $currentDateTime->toTimeString())
                                    ->whereTime('end_time', '>=', $currentDateTime->toTimeString());
                        });
                });
            })
            ->get();



            $studentEvents = Event::whereRaw("FIND_IN_SET(?, visible_to)", [$userId])
            ->where('status', 1)
            ->where(function($query) use ($currentDateTime) {
                $query->whereDate('start_date', '>', $currentDateTime->toDateString())
                      ->orWhere(function($subQuery) use ($currentDateTime) {
                          $subQuery->whereDate('start_date', '=', $currentDateTime->toDateString())
                                   ->whereTime('start_time', '>', $currentDateTime->toTimeString());
                      });
            })
            ->get();

        return view('events.index', compact('events', 'specific_events', 'coordinatorNames', 'studentEvents', 'live_events'));
    }


    public function list() {
        $events = Event::with('club')->get();
        return view('events.list', compact('events'));
    }

    public function edit($id)
    {
        $event = Event::with('club')->get();

        $coordinatorId = auth()->id();

        return view('events.edit', compact('event'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'club_id' => ['required', 'integer'],
            'venue' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255'],
            'end_date' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'string', 'max:255'],
            'end_date' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'selected_students_1' => ['required', 'string', 'max:255']
        ]);

        // Find the Event by its ID
        $event = Event::find($request->id);

        // Check if the Event exists
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Update the club's name and description
        $event->name = $request->name;
        $event->club_id = $request->club_id;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->color = $request->color;
        $event->visible_to = $request->selected_students_1;

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old logo file if it exists
            if ($event->image && file_exists(public_path('images/event_images/' . $event->image))) {
                unlink(public_path('images/event_images/' . $event->image));
            }

            // Store the new logo file
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images/event_images/'), $newImageName);
            $event->image = $newImageName;
        }

        // Save the changes
        $event->save();

        return redirect()->back()->with('success', 'Event updated successfully!');
    }

    public function approveReject(Request $request)
    {
        // Retrieve the approval status and data ID from the form
        $approvalStatus = $request->input('approval_status');
        $dataId = $request->input('data_id');
        
        $students = User::where('role', 'student')->get();

        // Find the event by ID
        $event = Event::find($dataId);
        // Check if event is found
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }
        
        // Update the event status
        $event->status = $approvalStatus;
        $event->save();
        
        // Find the coordinator associated with the event
        $coordinator = $event->coordinator;
        
        
        // Check if coordinator is found
        if (!$coordinator) {
            return redirect()->back()->with('error', 'Coordinator not found.');
        }

        // Send notification to the coordinator
        Notification::send($coordinator, new EventApproval($event, $approvalStatus));
        Notification::send($students, new InformEvent($event, $approvalStatus));

        return redirect()->back()->with('success', 'Status updated successfully!');
    }



    
    public function delete(Request $request){
        $clubs = Event::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }
}
