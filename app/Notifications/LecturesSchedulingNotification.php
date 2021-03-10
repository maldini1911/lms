<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LecturesSchedulingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     private $title;
     private $doctor;
     private $scheduling;
     private $type_scheduling;

    public function __construct($title, $doctor, $scheduling, $type_scheduling)
    {
        $this->title = $title;
        $this->doctor = $doctor;
        $this->scheduling = $scheduling;
        $this->type_scheduling = $type_scheduling;
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
    public function toDatabase($notifiable)
    {
        return [
            'title'             => $this->title,
            'doctor'            => $this->doctor,
            'scheduling'        => $this->scheduling,
            'type_scheduling'   => $this->type_scheduling,
        ];
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
}
