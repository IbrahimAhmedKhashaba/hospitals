<?php

namespace App\Repository\DoctorDashboard\Laboratories;

use App\Interfaces\DoctorDashboard\Laboratories\LaboratoryRepositoryInterface;
use App\Jobs\AddToLaboratorieSectionJob;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Notifications\AddPatientToLaboratoriesSectionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LaboratoryRepository implements LaboratoryRepositoryInterface
{

    public function store($request)
    {
        try {

            Laboratory::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
            ]);
            session()->flash('add');
            $patient = Patient::find($request->patient_id);
            AddToLaboratorieSectionJob::dispatch();
            Notification::send($patient, new AddPatientToLaboratoriesSectionNotification());
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $Laboratorie = Laboratory::findOrFail($id);
            $Laboratorie->update([
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
            Laboratory ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showLaboratory($id){
        $laboratory = Laboratory::findOrFail($id);
            if($laboratory->doctor_id != Auth::user()->id){
                return redirect()->route('404');
            }
            return view('Dashboard.Doctor.invoices.view_laboratories' , compact('laboratory'));
    }
}
