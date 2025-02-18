<?php


namespace App\Repository\LaboratoryEmployeeDashboard\Invoices;

use App\Interfaces\LaboratoryEmployeeDashboard\Invoices\InvoiceRepositoryInterface;
use App\Models\Doctor;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Notifications\AddLaboratoriesNotification;
use App\Notifications\AddLaboratoriesToPatientNotification;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    use UploadImageTrait;
        public function index()
   {
       $invoices = Laboratory::where('case',0)->get();
       return view('Dashboard.LaboratoryEmployee.Invoices.index',compact('invoices'));
   }

   public function completedInvoices()
   {
       $invoices = Laboratory::where('case',1)->where('laboratory_employee_id',auth()->user()->id)->get();
       return view('Dashboard.LaboratoryEmployee.Invoices.completed_invoices',compact('invoices'));
   }

    public function edit($id)
   {
       $invoice = Laboratory::findOrFail($id);
       return view('Dashboard.LaboratoryEmployee.Invoices.add_diagnosis',compact('invoice'));
   }

   public function viewLaboratories($id)
   {
    $laboratory = Laboratory::findOrFail($id);
    if($laboratory->laboratory_employee_id != Auth::user()->id){
        return redirect()->route('404');
    }
    return view('Dashboard.LaboratoryEmployee.Invoices.patient_details' , compact('laboratory'));

   }

   public function update($request, $id)
   {
    DB::beginTransaction();
       try{
        $invoice = Laboratory::findOrFail($id);
        $invoice->laboratory_employee_id = auth()->user()->id;
        $invoice->employee_description = $request->description_employee;
        $invoice->case = 1;
        $invoice->save();


       if( $request->hasFile( 'photo' ) ) {

             $this->verifyAndStoreImage($request , 'photo' , 'Laboratories' , 'upload_image' , $invoice->id , 'App\Models\Laboratory');

       }
       DB::commit();
       $doctor = Doctor::find($invoice->doctor_id);
       Notification::send($doctor, new AddLaboratoriesNotification($invoice->id));
       $patient = Patient::find($invoice->patient_id);
       Notification::send($patient, new AddLaboratoriesToPatientNotification($invoice->id));
       session()->flash('edit');
       return redirect()->route('invoices_laboratory_employee.index');
       } catch(\Exception $e){
        return $e->getMessage();
       }

   }
   
}
