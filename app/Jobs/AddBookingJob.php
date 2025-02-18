<?php

namespace App\Jobs;

use App\Notifications\AddBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class AddBookingJob implements ShouldQueue
{
    use Queueable;

    private $admins;
    public function __construct($admins)
    {
        //
        $this->admins = $admins;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Notification::send($this->admins , new AddBooking());

    }
}
