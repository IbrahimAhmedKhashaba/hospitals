<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateInvoiceNotification extends Notification
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
            'title' => 'تم إضافة فاتورة جديدة',
            'url' => route('invoices.index'),
        ];
    }
}
