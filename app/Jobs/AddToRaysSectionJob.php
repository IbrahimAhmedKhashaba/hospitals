<?php

namespace App\Jobs;

use App\Models\RayEmployee;
use App\Notifications\AddPatientToRaysSectionNotification;
use App\Notifications\AddToRaysSectionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class AddToRaysSectionJob implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
            $ray_employees = RayEmployee::all();
            Notification::send($ray_employees, new AddToRaysSectionNotification());

    }
}
