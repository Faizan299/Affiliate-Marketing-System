<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

use App\Notifications\approveClubRequest;
use App\Notifications\ClubRequestNotification;
use Illuminate\Support\Facades\Notification;


class ClubController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'logo' => 'required|mimes:jpg,jpeg,png,svg|max:5048'
        ]);


        $newImageName = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('images/club_logos'), $newImageName);

        // Create a new club instance
        $club = new Club();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->logo = $newImageName;
        $club->save();

        // Redirect back with a success message
        return redirect()->route('clubs.add')->with('success', 'Club registered successfully!');
    }

    public function show()
    {   
        $coordinatorId = auth()->id();

        // Retrieve all clubs
        $clubs = Club::all();

        // Retrieve specific clubs associated with the coordinator
        $user = User::findOrFail($coordinatorId);
        $specificClubIds = explode(',', $user->clubs);
        $specificClubs = Club::whereIn('id', $specificClubIds)->get();

        // $membersRequests = User::all()->filter(function ($user) use ($id) {
        //     $pendingClubs = explode(',', $user->pending_clubs);
        //     return in_array($id, $pendingClubs);
        // });

        // $events = Event::where('club_id', $id)->get();
        
        $pendingClubs = [];
        // Check if $user and $user->pending_clubs are not null before exploding
        if ($user && $user->pending_clubs) {
            $pendingClubs = explode(',', $user->pending_clubs);
        }
        
        $rejectedClubs = [];
        // Check if $user and $user->pending_clubs are not null before exploding
        if ($user && $user->rejected_clubs) {
            $rejectedClubs = explode(',', $user->rejected_clubs);
        }
        
        $approvedClubs = [];
        // Check if $user and $user->pending_clubs are not null before exploding
        if ($user && $user->clubs) {
            $approvedClubs = explode(',', $user->clubs);
        }
        

        // Remove leading and trailing commas if $user->clubs is not null
        $userClubs = $user ? trim($user->clubs, ',') : '';

        return view('clubs.index', compact('clubs', 'specificClubs', 'pendingClubs', 'rejectedClubs', 'approvedClubs'));
    }


    public function view($id) {

        $userId = auth()->id();

        $club = Club::find($id);

        $coordinators = User::where('clubs', 'like', '%' . $id . '%')->where('role', 'coordinator')->get();
        $members = User::where('clubs', 'like', '%' . $id . '%')->where('role', 'student')->get();
        
        $user = User::find($userId);

        $membersRequests = User::all()->filter(function ($user) use ($id) {
            $pendingClubs = explode(',', $user->pending_clubs);
            return in_array($id, $pendingClubs);
        });

        $events = Event::where('club_id', $id)->get();
        
        $pendingClubs = [];
        // Check if $user and $user->pending_clubs are not null before exploding
        if ($user && $user->pending_clubs) {
            $pendingClubs = explode(',', $user->pending_clubs);
        }
        
        $rejectedClubs = [];
        // Check if $user and $user->rejected are not null before exploding
        if ($user && $user->rejected_clubs) {
            $rejectedClubs = explode(',', $user->rejected_clubs);
        }
        
        $clubs = [];
        // Check if $user and $user->clubs are not null before exploding
        if ($user && $user->clubs) {
            $clubs = explode(',', $user->clubs);
        }
        
        // Remove leading and trailing commas if $user->clubs is not null
        $userClubs = $user ? trim($user->clubs, ',') : '';
        
        return view('clubs.view', compact('club', 'coordinators', 'events', 'user', 'pendingClubs', 'rejectedClubs', 'members', 'membersRequests', 'userClubs', 'clubs'));
    }


    public function approveReject(Request $request)
    {
        // Retrieve the approval status and data ID from the form
        $approvalStatus = $request->input('approval_status');
        $userId = $request->input('data_id');
        $clubId = $request->input('clubId');

        // Find the user and the club
        $user = User::find($userId);
        $club = Club::find($clubId);

        if (!$user || !$club) {
            return redirect()->back()->with('error', 'Invalid user or club.');
        }

        // Retrieve pending clubs and convert them to an array
        $pendingClubs = explode(',', $user->pending_clubs);

        // Remove $clubId from the pending clubs array
        $pendingClubs = array_diff($pendingClubs, [$clubId]);

        // Convert the pending clubs array back to a string
        $user->pending_clubs = implode(',', $pendingClubs);

        // Determine which column to use based on approval status
        if ($approvalStatus == 1) {
            // Add $clubId to clubs column
            if ($user->clubs) {
                $user->clubs .= ',' . $clubId;
            } else {
                $user->clubs = $clubId;
            }
        } elseif ($approvalStatus == 2) {
            // Add $clubId to rejected_clubs column
            if ($user->rejected_clubs) {
                $user->rejected_clubs .= ',' . $clubId;
            } else {
                $user->rejected_clubs = $clubId;
            }
        }

        // Save the user
        $user->save();

        // Send the notification to the user
        Notification::send($user, new approveClubRequest($club, $user, $approvalStatus));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Status updated successfully!');
    }


    public function edit($id)
    {
        $club = Club::find($id);
        return view('clubs.edit', compact('club'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'logo' => 'nullable|mimes:jpg,jpeg,png,svg|max:5048',
        ]);

        // Find the club by its ID
        $club = Club::find($request->id);

        // Check if the club exists
        if (!$club) {
            return redirect()->back()->with('error', 'Club not found.');
        }

        // Update the club's name and description
        $club->name = $request->name;
        $club->description = $request->description;

        // Check if a new logo file has been uploaded
        if ($request->hasFile('logo')) {
            // Delete the old logo file if it exists
            if ($club->logo && file_exists(public_path('images/club_logos/' . $club->logo))) {
                unlink(public_path('images/club_logos/' . $club->logo));
            }

            // Store the new logo file
            $newImageName = time() . '-' . $request->name . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/club_logos'), $newImageName);
            $club->logo = $newImageName;
        }

        // Save the changes
        $club->save();

        return redirect()->back()->with('success', 'Club updated successfully!');
    }


    public function delete(Request $request){
        $clubs = Club::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }

    public function register(Request $request)
    {
        // Get the user ID
        $userId = auth()->id();
        $clubId = $request->input('clubId');

        // Find the user and the club
        $user = User::find($userId);
        $club = Club::find($clubId);

        if (!$user || !$club) {
            return response()->json(['error' => 'Invalid user or club'], 400);
        }


        // Update the pending clubs for the user
        if (!$user->pending_clubs) {
            $user->pending_clubs = $clubId;
        } else {
            $user->pending_clubs .= ',' . $clubId;
        }

        // Save the user
        $user->save();

        // Find admins and coordinators
        $adminAndCoordinator = User::where('role', 'admin')
                                    ->orWhere('role', 'coordinator')
                                    ->get();

        // Send the notification
        Notification::send($adminAndCoordinator, new ClubRequestNotification($club, $user));

        return response()->json(['success' => 'Registered Successfully!'], 201);
    }

}
