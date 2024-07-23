<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Event;
use App\Models\User;
use App\Models\Club;
use App\Models\News;
use App\Models\EventAttendee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        
        // Retrieve students with the role 'student'
        $students = User::where('role', 'student')->get();
        
        // Initialize an array to store the count of event attendees for each student
        $eventAttendeesCount = [];
    
        // Loop through each student
        foreach ($students as $student) {
            // Count the number of event attendees for the current student
            $attendeeCount = EventAttendee::where('student_id', $student->id)->where('attended_status', 1)
            ->count();
    
            // Store the count in the array with the student's ID as the key
            $eventAttendeesCount[$student->id] = $attendeeCount;
        }
            
        // Pass the students and event attendees count to the view
        return view('students.index', compact('students', 'eventAttendeesCount'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login_id' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string'],
            'course' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->student_id = $request->login_id;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->course = $request->course;
        $user->password = bcrypt($request->password); // Ensure to hash the password before saving
        $user->role = 'student';
        $user->member_role = 'Member';
        $user->email_verified_at = date('Y-m-d h:i:s');
        $user->save();

        // Redirect back with a success message
        return redirect()->route('students.add')->with('success', 'Student registered successfully!');
    }

    public function add() {
        return view('students.add');
    }

    public function delete(Request $request){
        $clubs = User::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }

    public function edit($id) {
        $student = User::where('role', 'student')->where('id', $id)->first();

        return view('students.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'member_role' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
        ]);

        // Find the Event by its ID
        $student = User::find($request->id);

        // Check if the Event exists
        if (!$student) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Update the club's name and description
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->member_role = $request->member_role;
        $student->course = $request->course;

        $student->save();

        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function view($id) {
        $student = User::where('role', 'student')->where('id', $id)->first();
        $associatedClubs = User::find($id);
        $clubIds = explode(',', $associatedClubs->clubs);
        $clubs = Club::whereIn('id', $clubIds)->get();
        
        
        return view('students.view', compact('student', 'clubs'));
    }

    public function home() {
        $userId = auth()->id();
        $events = Event::with('club')->get();
        $specific_events = Event::where('coordinator_id', $userId)->with('club')->get();
        $coordinatorName = User::where('id', $userId)->value('name');
        $carousel = Carousel::all();
        $all_events = Event::all();
        $latestNews = News::where('created_at', '>=', Carbon::now()->subDays(5))->get();
        $startDateOfWeek = Carbon::now()->startOfWeek();
        $endDateOfWeek = Carbon::now()->endOfWeek();
        $currentDateTime = Carbon::now();
        
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

        $currentDateTime = Carbon::now();
        $currentDate = $currentDateTime->toDateString();
        $currentTime = $currentDateTime->toTimeString(); // Ensure $currentDateTime is defined

        $currentDateTime = now();
        $userId = auth()->id(); // Assuming you're getting the current authenticated user

        $currentDateTime = now();
        $userId = auth()->id(); // Assuming you're getting the current authenticated user

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




        // Count attendees for each event
        $eventAttendeesCount = [];
        foreach ($all_events as $event) {
            $eventAttendeesCount[$event->id] = EventAttendee::where('event_id', $event->id)->count();
        }


        $eventScore = EventAttendee::where('student_id', $userId)->where('attended_status', 1)->count(); 
        return view('home', compact('events', 'specific_events', 'latestNews', 'coordinatorName', 'studentEvents', 'live_events', 'carousel', 'eventAttendeesCount', 'eventScore'));
    }

    public function profile($id) {
        $student = User::find($id);
        $pendingClubsCount = 0; 
        $rejectedClubsCount = 0; 
        $approvedclubsCount = 0; 
        $studentScore = EventAttendee::where('student_id', $id)->count();
        $specificUpcomingEvents = Event::where('start_date', '>', date('Y-m-d'))->where('coordinator_id', $id)->where('status', '1')->count();
        $upcomingEvents = Event::where('start_date', '>', now())->orderBy('id')->count();
        $clubCount = Club::count();
        $upcomingStudentEvents = Event::whereRaw("FIND_IN_SET(?, visible_to)", [Auth::user()->id])->where('status', 1)->whereDate('start_date', '>', now())->count();

        return view('students.profile', [
            'student' => $student,
            'studentScore' => $studentScore,
            'pendingClubsCount' => $pendingClubsCount,
            'rejectedClubsCount' => $rejectedClubsCount,
            'approvedclubsCount' => $approvedclubsCount,
            'upcomingStudentEvents' => $upcomingStudentEvents,
            'clubCount' => $clubCount,
            'specificUpcomingEvents' => $specificUpcomingEvents,
            'upcomingEvents' => $upcomingEvents
        ]);
    }

    public function update_profile(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'course' => 'required|string|max:255',
        ]);
    
        // Find the Student by its ID
        $student = User::find($id);
    
        // Check if the Student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
    
        // Update the student's details
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->course = $request->course;
    
        $student->save();
    
        return redirect()->back()->with('success', 'Data updated successfully!');
    }
}
