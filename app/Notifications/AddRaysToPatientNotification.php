<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddRaysToPatientNotification extends Notification
{
    private $ray_id;
    public function __construct($ray_id)
    {
        //
        $this->ray_id = $ray_id;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable){
        return [
            'title' => 'تم إضافة تشخيص أشعة جديد لك',
            'url' => route('patient.viewRay' , $this->ray_id),
        ];
    }
}
