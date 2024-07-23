<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Event;
use App\Models\Club;
use App\Models\EventAttendee;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index() {

        //admin
        $totalEvents = Event::count();
        $pendingEvents = Event::where('status', '0')->count();
        $rejectedEvents = Event::where('status', '2')->count();
        $upcomingEvents = Event::where('start_date', '>', now())->orderBy('id')->count();
        $pastEvent = Event::where('end_date', '>', now())->orderBy('id')->count();
        $clubCount = Club::count();
        $studentCount = User::where('role', 'student')->count();
        $coordinatorCount = User::where('role', 'coordinator')->count();

        //club coordinator
        $id = auth()->id();
        $specificPendingEvents = Event::where('coordinator_id', $id)->where('status', 0)->count();
        $specificUpcomingEvents = Event::where('start_date', '>', date('Y-m-d'))->where('coordinator_id', $id)->where('status', '1')->count();
        $specificPastEvents = Event::where('start_date', '<', date('Y-m-d'))->where('coordinator_id', $id)->where('status', '1')->count();
        $specificRejectedEvents = Event::where('coordinator_id', $id)->where('status', 2)->count();
        $specificTotalEvents = Event::where('coordinator_id', $id)->count();
        $user = User::findOrFail($id);
        $clubIds = explode(',', $user->clubs);
        $specificClubs = Club::whereIn('id', $clubIds)->pluck('name')->count(); 
        
        //students
        $pendingClubsCount = 0; 
        $rejectedClubsCount = 0; 
        $approvedclubsCount = 0; 
        $studentScore = EventAttendee::where('student_id', $id)->count();

        $upcomingStudentEvents = Event::whereRaw("FIND_IN_SET(?, visible_to)", [Auth::user()->id])->where('status', 1)->whereDate('start_date', '>', now())->count();

        // Check if $user and $user->pending_clubs are not null before exploding
        if ($user && $user->pending_clubs) {
            // Explode the string to get an array of pending clubs
            $pendingClubs = explode(',', $user->pending_clubs);
            
            // Count the number of elements in the array
            $pendingClubsCount = count($pendingClubs);
        }
        
        if ($user && $user->rejected_clubs) {
            // Explode the string to get an array of pending clubs
            $rejectedClubs = explode(',', $user->rejected_clubs);
            
            // Count the number of elements in the array
            $rejectedClubsCount = count($rejectedClubs);
        }
        
        if ($user && $user->clubs) {
            // Explode the string to get an array of pending clubs
            $clubs = explode(',', $user->clubs);
            
            // Count the number of elements in the array
            $approvedclubsCount = count($clubs);
        }
        
        $notifications = Auth::user()->notifications;

        
        
        return view('dashboard', [
            //admin
            'totalEvents' => $totalEvents,
            'pendingEvents' => $pendingEvents,
            'rejectedEvents' => $rejectedEvents,
            'pastEvent' => $pastEvent,
            'upcomingEvents' => $upcomingEvents,
            'clubCount' => $clubCount,
            'studentCount' => $studentCount,
            'coordinatorCount' => $coordinatorCount,
            
            //club Coordinator
            'specificPendingEvents' => $specificPendingEvents,
            'specificUpcomingEvents' => $specificUpcomingEvents,
            'specificPastEvents' => $specificPastEvents,
            'specificRejectedEvents' => $specificRejectedEvents,
            'specificTotalEvents' => $specificTotalEvents,
            'specificClubs' => $specificClubs,

            //Students
            'studentScore' => $studentScore,
            'pendingClubsCount' => $pendingClubsCount,
            'rejectedClubsCount' => $rejectedClubsCount,
            'approvedclubsCount' => $approvedclubsCount,
            'upcomingStudentEvents' => $upcomingStudentEvents,
            'notifications' => $notifications
            
        ]);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
    

}
