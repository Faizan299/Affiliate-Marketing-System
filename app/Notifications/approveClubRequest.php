<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Club;  // Make sure to include the Club model
use App\Models\User;  // Make sure to include the User model

class approveClubRequest extends Notification
{
    use Queueable;

    protected $club;
    protected $status;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(Club $club, User $user, $status)
    {
        $this->club = $club;
        $this->user = $user;
        $this->status = $status;
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
            ->subject('Club Request has' . ($this->status == 1 ? 'Approved' : 'Rejected'))
            ->line('Club Request has' . ($this->status == 1 ? 'Approved' : 'Rejected'))
            ->line('Your joining request for ' . $this->club->name . ' has been ' . ($this->status == 1 ? 'approved' : 'rejected'))
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
            'message' => 'Club Request has' . ($this->status == 1 ? 'Approved' : 'Rejected'),
            'description' => 'Your joining request for ' . $this->club->name . ' has been ' . ($this->status == 1 ? 'approved' : 'rejected')
        ];
    }
}
