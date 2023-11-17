<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class Invite extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $user, $project_id;
    public function __construct($user, $project_id=null)
    {
        $this->user = $user;
        $this->project_id = $project_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('You are invited for new project')
                    ->line('The introduction to the notification.')
                    ->action('Accept Invitation', route('invite', ['user_id' => Crypt::encryptString($this->user->id), 'project_id' => $this->project_id]))
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
            //
        ];
    }
}
