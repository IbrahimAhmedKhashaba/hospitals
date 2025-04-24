<?php


namespace App\Repository\RayEmployeeDashboard\Invoices;

use App\Interfaces\RayEmployeeDashboard\Invoices\InvoiceRepositoryInterface;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Ray;
use App\Notifications\AddRaysNotification;
use App\Notifications\AddRaysToPatientNotification;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    use UploadImageTrait;
        public function index()
   {
       $invoices = Ray::where('case',0)->get();
       return view('Dashboard.RayEmployee.Invoices.index',compact('invoices'));
   }

   public function completedInvoices()
   {
       $invoices = Ray::where('case',1)->where('ray_employee_id',auth()->user()->id)->get();
       return view('Dashboard.RayEmployee.Invoices.completed_invoices',compact('invoices'));
   }

    public function edit($id)
   {
       $invoice = Ray::findOrFail($id);
       return view('Dashboard.RayEmployee.Invoices.add_diagnosis',compact('invoice'));
   }

   public function viewRays($id)
   {
    $rays = Ray::findOrFail($id);
    if($rays->ray_employee_id != Auth::user()->id){
        return redirect()->route('404');
    }
    return view('Dashboard.RayEmployee.Invoices.patient_details' , compact('rays'));

   }

   public function update($request, $id)
   {
    DB::beginTransaction();
       try{
        $invoice = Ray::findOrFail($id);
        $invoice->ray_employee_id = auth()->user()->id;
        $invoice->employee_description = $request->description_employee;
        $invoice->case = 1;
        $invoice->save();


       if( $request->hasFile( 'photo' ) ) {

        //  foreach ($request->photos as $photo) {
             $this->verifyAndStoreImage($request , 'photo' , 'Rays' , 'upload_image' , $invoice->id , 'App\Models\Ray');
            // }

       }
       DB::commit();
       $doctor = Doctor::find($invoice->doctor_id);
       $patient = Patient::find($invoice->patient_id);
       Notification::send($doctor, new AddRaysNotification($invoice->id));
       Notification::send($patient, new AddRaysToPatientNotification($invoice->id));
       session()->flash('edit');
       return redirect()->route('invoices_ray_employee.index');
       } catch(\Exception $e){
        return $e->getMessage();
       }

   }
}
