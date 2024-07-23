<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Club;
use App\Models\User;

class ClubRequestNotification extends Notification
{
    use Queueable;
    protected $club;
    protected $user;
    
    /**
     * Create a new notification instance.
     */
    public function __construct(Club $club, User $user)
    {
        $this->club = $club;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Club Joining Request')
            ->line('<strong>' . $this->user->name . '</strong>' . ' is requested to join club ' . '<strong>' . $this->club->name . '</strong>.')
            ->action('View Notification', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'club_id' => $this->club->id,
            'message' => 'Club Joining Request',
            'description' => '<strong>' . $this->user->name . '</strong>' . ' is requested to join club ' . '<strong>' . $this->club->name . '</strong>.'
        ];
    }
}
