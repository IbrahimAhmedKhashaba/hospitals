<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddPaymentNotification extends Notification
{
    use Queueable;
    private $amount;
    public function __construct($amount)
    {
        //
        $this->amount = $amount;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable){
        return [
            'title' => 'تم إضافة سند صرف بقيمة '.$this->amount,
            'url' => route('patient.payments'),
        ];
    }
}
