<?php

namespace App\Repository\DoctorDashboard\Rays;
use App\Interfaces\DoctorDashboard\Rays\RaysRepositoryInterface;
use App\Jobs\AddToRaysSectionJob;
use App\Models\Patient;
use App\Models\Ray;
use App\Notifications\AddPatientToRaysSectionNotification;
use Illuminate\Support\Facades\Notification;

class RaysRepository implements RaysRepositoryInterface
{

    public function store($request)
    {
        try {
            Ray::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
            ]);
            session()->flash('add');
            $patient = Patient::find($request->patient_id);
            AddToRaysSectionJob::dispatch();
            Notification::send($patient, new AddPatientToRaysSectionNotification());

            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $Ray = Ray::findOrFail($id);
            $Ray->update([
                'description' => $request->description,
            ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Ray ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
