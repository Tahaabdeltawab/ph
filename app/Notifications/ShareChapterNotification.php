<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShareChapterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($chapter)
    {
        $this->title = auth()->user()->email.' has shared with you the topic: '.$chapter->topic->title.'. Chapter: '.$chapter->title;
        $this->chapter = $chapter;
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

    
    public function toDatabase($notifiable)
    {
        $return = [
            'title'         => $this->title,
            'chapter'        => $this->chapter,
            'notifiable'    => $notifiable,
            'sender'        => auth()->user(),
        ];
        return $return;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $return = [
            'title'         => $this->title,
            'chapter'        => $this->chapter,
            'notifiable'    => $notifiable,
            'sender'        => auth()->user(),
        ];
        return $return;
    }
}
