<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddPatientToLaboratoriesSectionNotification extends Notification
{
    use Queueable;
    public function __construct()
    {
        //
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable){
        return [
            'title' => 'تم تحويلك إلى قسم المختبر',
            'url' => route('patient.laboratories'),
        ];
    }
}
