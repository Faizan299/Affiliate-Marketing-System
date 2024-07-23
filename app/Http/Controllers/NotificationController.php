<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendCustomNotification(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'selected_students_1' => 'required|string',
        ]);

        $studentIds = explode(',', $request->input('selected_students_1'));
        $students = User::whereIn('id', $studentIds)->get();

        Notification::send($students, new CustomNotification($request->message, $request->description));

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }
}
