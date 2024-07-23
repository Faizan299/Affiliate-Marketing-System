<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventAttendeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Artisan;

use App\Models\Club;
use App\Models\Event;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/calender', [CalendarController::class, 'show'])->name('calendar.index');
        Route::get('/calender/calendar-events', [CalendarController::class, 'getEvents'])->name('calendar.events');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/clubs', [ClubController::class, 'show'])->name('clubs.index');
        Route::get('/clubs/add', function () {
            return view('clubs.add');
        })->name('clubs.add');
        Route::post('/club/register', [ClubController::class, 'register'])->name('club.register');
        Route::post('/clubs/add', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/clubs/view/{id}', [ClubController::class, 'view'])->name('clubs.view');
        Route::get('/clubs/edit/{id}', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::post('/clubs/update/{id}', [ClubController::class, 'update'])->name('clubs.update');
        Route::get('/clubs/delete/{id}', [ClubController::class, 'delete'])->name('clubs.delete');
        Route::post('/club/approveReject', [ClubController::class, 'approveReject'])->name('clubs.approveReject');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/coordinators', [CoordinatorController::class, 'show'])->name('coordinators.index');
        Route::get('/coordinators/add', function () {
            $clubs = Club::all(); // Retrieve all clubs
            return view('coordinators.add', compact('clubs'));
        })->name('coordinators.add');
        Route::post('/coordinators/add', [CoordinatorController::class, 'store'])->name('coordinators.store');
        Route::get('/coordinators/view/{id}', [CoordinatorController::class, 'view'])->name('coordinators.view');
        Route::get('/coordinators/edit/{id}', [CoordinatorController::class, 'edit'])->name('coordinators.edit');
        Route::post('/coordinators/update/{id}', [CoordinatorController::class, 'update'])->name('coordinators.update');
        Route::get('/coordinators/delete/{id}', [CoordinatorController::class, 'delete'])->name('coordinators.delete');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/add', function () {
            return view('news.add');
        })->name('news.add');
        Route::post('/news/add', [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/view/{id}', [NewsController::class, 'view'])->name('news.view');
        Route::get('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/add', [StudentController::class, 'add'])->name('students.add');
        Route::post('/students/add', [StudentController::class, 'store'])->name('students.store');
        Route::get('/student/delete', [StudentController::class, 'delete'])->name('students.delete');
        Route::get('/student/view/{id}', [StudentController::class, 'view'])->name('students.view');
        Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
        Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('/student/profile/{id}', [StudentController::class, 'profile'])->name('student.profile');
        Route::post('student/profile/update/{id}', [StudentController::class, 'update_profile'])->name('profile.update');
    });
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
        Route::get('/carousel/add', [CarouselController::class, 'add'])->name('carousel.add');
        Route::get('/carousel/view/{id}', [CarouselController::class, 'view'])->name('carousel.view');
        Route::get('/carousel/delete/{id}', [CarouselController::class, 'delete'])->name('carousel.delete');
        Route::post('/carousel/add', [CarouselController::class, 'store'])->name('carousel.store');
        Route::get('/carousel/edit/{id}', [CarouselController::class, 'edit'])->name('carousel.edit');
        Route::post('/carousel/update/{id}', [CarouselController::class, 'update'])->name('carousel.update');
    });
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/home', [StudentController::class, 'home'])->name('students.home');
    });
    
   

    Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/event/register', [EventController::class, 'register'])->name('event.register');
    Route::post('/event/attendance', [EventController::class, 'attendance'])->name('event.attendance');
    Route::get('/events', [EventController::class, 'show'])->name('events.index');
    Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
    Route::get('/events/add', function () {
        $clubs = Club::all();
        $students = User::where('role', 'student')->get();

        $coordinatorId = auth()->id();
        $user = User::findOrFail($coordinatorId);
        $specificClubIds = explode(',', $user->clubs);
        $specificClubs = Club::whereIn('id', $specificClubIds)->get();
    
        return view('events.add', compact('clubs', 'students', 'specificClubs'));
    })->name('events.add');    
    
    Route::post('/events/add', [EventController::class, 'store'])->name('events.store');
    
    Route::get('/events/edit/{id}', function ($id) {
        $event = Event::findOrFail($id); // Retrieve the event by ID
        $clubs = Club::all(); // Retrieve all clubs
        $students = User::where('role', 'student')->get(); // Retrieve all user
        $visibleTo = explode(',', $event->visible_to);
        return view('events.edit', compact('event', 'clubs', 'students', 'visibleTo'));
    })->name('events.edit');   
    
    Route::post('/events/approveReject', [EventController::class, 'approveReject'])->name('events.approveReject');
    Route::post('/events/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
    Route::get('/events/view/{id}', [EventController::class, 'view'])->name('events.view');

    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/event_attendees', [EventAttendeeController::class, 'index'])->name('eventAttendees.index');
        Route::post('/event_attendees/students_list', [EventAttendeeController::class, 'studentList'])->name('events.studentsList');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('/send-custom-notification', [NotificationController::class, 'sendCustomNotification'])->name('send.custom.notification');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/markAllAsRead', [DashboardController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/profile', function () {
        // Only verified users may access this route...
    })->middleware(['auth', 'verified']);

    Route::get('/run-scheduler', function (Request $request) {
        $token = $request->query('token');
        if ($token !== config('app.scheduler_token')) {
            abort(403, 'Unauthorized action.');
        }
        Artisan::call('run:scheduler');
        return 'Scheduler run successfully';
    });

    require __DIR__.'/auth.php';
