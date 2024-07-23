<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Club;
use App\Models\User;
use App\Models\Event;

class EventApproval extends Notification
{
    use Queueable;

    protected $event;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Event  $event
     * @param  int  $status
     * @return void
     */
    public function __construct($event, $status)
    {
        $this->event = $event;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $statusMessage = $this->status == 1 ? 'approved' : 'rejected';
        $title = 'Event ' . ucfirst($statusMessage);
        $description = 'The event ' . $this->event->name . ' has been ' . $statusMessage . '.';

        return (new MailMessage)
                    ->subject('Notification: ' . $title)
                    ->line($title)
                    ->line($description)
                    ->action('View Notification', url('/'))
                    ->line('Thank you for using our application!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $statusMessage = $this->status == 1 ? 'approved' : 'rejected';
        return [
            'event_id' => $this->event->id,
            'message' => 'Event has been ' . ($this->status == 1 ? 'approved' : 'rejected') . '.',
            'description' => $this->event->name . ' has been ' . ($this->status == 1 ? 'approved' : 'rejected')
        ];
    }
}
