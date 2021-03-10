<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LecturesStudent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */



     private $title;
     private $doctor;
     private $type;
     private $id_type;

    public function __construct($title, $doctor, $type, $id_type)
    {
        $this->title = $title;
        $this->doctor = $doctor;
        $this->type = $type;
        $this->id_type = $id_type;
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


    public function toDatabase($notifiable)
    {
        return [
            'title'     => $this->title,
            'doctor'    => $this->doctor,
            'type'      => $this->type,
            'id_type'   => $this->id_type,
            ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
