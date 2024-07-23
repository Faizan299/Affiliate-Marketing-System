<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EventController;

use App\Models\Event;

class CalendarController extends Controller
{
    public function show()
    {
        return view('calendar.index');
    }
    
    public function getEvents()
    {
        $events = Event::where('status', 1)->get(); // Fetch events from the database
        return response()->json($events);
    }

}
