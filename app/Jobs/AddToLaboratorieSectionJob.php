<?php

namespace App\Jobs;

use App\Models\LaboratoryEmployee;
use App\Notifications\AddToLaboratoriesSectionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class AddToLaboratorieSectionJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $laboratory_employees = LaboratoryEmployee::all();
        Notification::send($laboratory_employees, new AddToLaboratoriesSectionNotification());
    }
}
