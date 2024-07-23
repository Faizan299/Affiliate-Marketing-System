<?php
namespace App\Providers;

use App\Http\ViewComposers\NotificationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\EventAttendee;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Attach the NotificationComposer to the views that require notifications
        View::composer('*', NotificationComposer::class);

        // Ensure that eventScore is shared with all views
        View::composer('*', function ($view) {
            $view->with('eventScore', $this->getEventScore());
        });

        config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    private function getEventScore()
    {
        $userId = auth()->id();
        if ($userId) {
            return EventAttendee::where('student_id', $userId)->where('attended_status', 1)->count();
        }
        return 0; // Return 0 if user is not authenticated
    }
}
