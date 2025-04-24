<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddLaboratoriesToPatientNotification extends Notification
{
    private $laboratory_id;
    public function __construct($laboratory_id)
    {
        //
        $this->laboratory_id = $laboratory_id;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable){
        return [
            'title' => 'تم إضافة تشخيص مختبر جديد لك',
            'url' => route('patient.viewLaboratory' , $this->laboratory_id),
        ];
    }
}
