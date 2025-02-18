<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddReceiptNotification extends Notification
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
            'title' => 'تم إضافة سند قبض بقيمة '.$this->amount,
            'url' => route('patient.payments'),
        ];
    }
}
