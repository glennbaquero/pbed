<?php

namespace App\Notifications\Admin\RequestInformation;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestInformationNotification extends Notification
{
    use Queueable;

    protected $subject;
    protected $message;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $type, $contactUrl, $message)
    {
        $this->subject = $subject;
        $this->message = $message.' '.$type;
        $this->contactUrl = $contactUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(env('APP_NAME') . ": ". $this->subject)
                    ->greeting('Hello '. $notifiable->renderName())                                                
                    ->line($this->message)
                    ->line('Please click the button below to be redirected to the record.')
                    ->action('Contact Info Record', url($this->contactUrl))
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
        return [
            'message' => $this->message,
            'title' => $this->subject,
            'subject_id' => $notifiable->id, 
            'subject_type' => get_class($notifiable),
        ];
    }
}
