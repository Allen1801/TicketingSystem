<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class EmailNotification extends Notification
{
    use Queueable;
    public $findEmail;

    /**
     * Create a new notification instance.
     */
    public function __construct($findEmail)
    {
        $this->findEmail = $findEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $surveyLink = URL::to('/survey');
        return (new MailMessage)
                    ->subject('Ticket Updated')
                    ->line('Your ticket (ID: ' . $this->findEmail->id . ') has been ' . $this->findEmail->status . ' by ' . $this->findEmail->handler . '.')
                    ->line('Thank you for using our application!')
                    ->line($this->findEmail->solution)
                    ->action('Fill up the survey' , $surveyLink);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->findEmail->id,
            'message' => 'Your Ticket (ID: ' . $this->findEmail->id . ') has been ' . $this->findEmail->status . ' by ' . $this->findEmail->handler . '.',
        ];
    }
}
