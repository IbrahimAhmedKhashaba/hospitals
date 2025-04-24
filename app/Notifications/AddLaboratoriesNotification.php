<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddLaboratoriesNotification extends Notification
{
    use Queueable;
    private $invoice_id;
    public function __construct($invoice_id)
    {
        //
        $this->invoice_id = $invoice_id;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable){
        return [
            'title' => 'تم إضافة تشخيص مختبر جديد',
            'url' => route('showLaboratory' , $this->invoice_id),
        ];
    }
}
