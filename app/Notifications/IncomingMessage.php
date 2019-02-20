<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IncomingMessage extends Notification
{
    use Queueable;


    public $sender;
    public $email;
    public $message;
    public $subject;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender,$email,$subject,$message)
    {
        $this->sender = $sender;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            //
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $data = array([
            'sender'=>$this->sender,
            'email'=>$this->email,
            'subject'=>$this->subject,
            'message'=>$this->message
            ]);
        return [
            'subject'=>'Incoming Message',
            'data'=>$data
        ];
    }
}
