<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailNotSend extends Notification
{
    use Queueable;

    public $receiver;
    public $message;
    public $subject;
    public $reasonOfNotSend;
    public $reasonOfMessage;
    public $attachDocument;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($receiver,$message,$subject,$attachDocument,$reasonOfMessage,$reasonOfNotSend)
    {
        $this->receier = $receiver;
        $this->attachDocument = $attachDocument;
        $this->subject = $subject;
        $this->message = $message;
        $this->reasonOfMessage = $reasonOfMessage;
        $this->reasonOfNotSend = $reasonOfNotSend;
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
            'reasonOfNotSend'=>$this->reasonOfNotSend,
            'reasonOfMessage'=>$this->reasonOfMessage,
            'receiver'=>$this->receier,
            'attachDocument'=>$this->attachDocument,
            'subject'=>$this->subject,
            'message'=>$this->message
        ]);
        return [
            'subject'=>'Mail not send',
            'data'=>$data
        ];
    }
}
