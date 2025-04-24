<?php


namespace App\Repository\PatientDashboard;

use App\Interfaces\PatientDashboard\PatientDashboardRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratory;
use App\Models\PatientAccount;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class PatientDashboardRepository implements PatientDashboardRepositoryInterface
{
    public function invoices(){
        $invoices = Invoice::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.patient.invoices', compact('invoices'));
    }
    public function laboratories(){
        $laboratories = Laboratory::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.patient.laboratories', compact('laboratories'));
    }
    public function viewLaboratory($id){
        $laboratory = Laboratory::findOrFail($id);
        if($laboratory->patient_id != Auth::user()->id){
            return view('Dashboard.404');
        }
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratory'));
    }
    public function rays(){
        $rays = Ray::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.patient.rays', compact('rays'));
    }
    public function viewRay($id){
        $ray = Ray::findOrFail($id);
        if($ray->patient_id != Auth::user()->id){
            return view('Dashboard.404');
        }
        return view('Dashboard.Doctor.invoices.view_rays', compact('ray'));
    }

    public function payments(){
        $Patient_accounts = PatientAccount::with(['receipt_account' , 'payment_account' , 'invoice'])->where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.patient.payments', compact(['Patient_accounts' , 'payLink']));
    }

}
