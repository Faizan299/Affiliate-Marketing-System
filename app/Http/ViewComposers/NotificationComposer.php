<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\EventAttendee;

class NotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $notifications = Auth::user()->notifications;
            $view->with('notifications', $notifications);
        }
        $userId = Auth::id();
        $eventScore = 0;
        if ($userId) {
            $eventScore = EventAttendee::where('student_id', $userId)->where('attended_status', 1)->count();
        }

        $view->with('eventScore', $eventScore);
    }
}
