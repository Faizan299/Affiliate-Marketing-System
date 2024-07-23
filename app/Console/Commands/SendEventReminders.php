<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Event;
use App\Notifications\EventReminder;
use Illuminate\Support\Facades\Notification;

class SendEventReminders extends Command
{
    protected $signature = 'send:event-reminders';

    protected $description = 'Send reminders for events starting in 30 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $events = Event::where('start_date', Carbon::today()->toDateString())
                        ->where('start_time', '>=', Carbon::now()->addMinutes(30)->toTimeString())
                        ->where('start_time', '<=', Carbon::now()->addMinutes(30)->addSeconds(59)->toTimeString())
                        ->get();

        foreach ($events as $event) {
            Notification::send($event->user, new EventReminder($event));
        }

        return 0;
    }
}