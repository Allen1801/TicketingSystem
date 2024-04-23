<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTicketNotification extends Notification
{
    use Queueable;
    public $insert;
    /**
     * Create a new notification instance.
     */
    public function __construct($insert)
    {
        $this->insert = $insert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->insert->id,
            'message' => 'New Ticket has been created under the email ' . $this->insert->email . '.',

        ];
    }
}
