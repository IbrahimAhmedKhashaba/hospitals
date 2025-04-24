<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\SingleInvoice;
use App\Notifications\AddInvoiceToPatientNotification;
use App\Notifications\CreateInvoiceNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $InvoiceSaved, $InvoiceUpdated;
    public $show_table = true;
    public $updateMode = false;

    public $username;
    public $tax_rate = 17;

    public $price,$discount_value = 0 ,$patient_id,$doctor_id,$section_id,$type,$service_id,$single_invoice_id,$catchError;
    public function render()
    {
        $single_invoices = Cache::remember('single_invoices' , 3600 , function(){
            return Invoice::with(['doctor.translations' , 'patient.translations'])->where('invoice_type' , 1)->get();
        });
        $Patients = Cache::remember('Patients' , 3600 , function(){
            return Patient::with(['translations' , 'invoice'])->get();
        });
        $doctors = Cache::remember('doctors', 3600, function () {
            return Doctor::with(['translations', 'section.translations', 'image', 'appointments.translations'])->get();
        });
        $services = Cache::remember('services' , 3600 , function(){
            return Service::with('translations')->get();
        });
        return view('livewire.SingleInvoices.single-invoices' , [
            'single_invoices' => $single_invoices,
            'patients' => $Patients,
            'doctors' => $doctors,
            'services' => $services,
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add(){
        $this->show_table = false;
    }

    public function get_section(){
        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price(){
        $this->price = Service::with('translations')->where('id' , $this->service_id)->first()->price;
    }

    public function edit($id){

        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = Invoice::findOrFail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->service_id = $single_invoice->service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;


    }

    public function store(){
        $single_invoices = [];
        $fund_accounts = [];
        $patient_accounts = [];
        DB::beginTransaction();
            try {
                if($this->updateMode){

                    $single_invoices =  Invoice::findOrFail($this->single_invoice_id);
                    if($this->type == 1){
                        $fund_accounts = FundAccount::where('invoice_id' , $this->single_invoice_id)->first();
                    } else{
                        $patient_accounts = PatientAccount::where('invoice_id' , $this->single_invoice_id)->first();
                    }
                } else {

                    $single_invoices = new Invoice();
                    if($this->type == 1){
                        $fund_accounts = new FundAccount();
                    } else{
                        $patient_accounts = new PatientAccount();
                    }
                }
                $this->show_table = true;
                $single_invoices->invoice_type = 1;
                $single_invoices->invoice_status = 1;
                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;
                $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $single_invoices->service_id = $this->service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;
                $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                $single_invoices->type = $this->type;
                $single_invoices->save();
                if($this->type == 1){
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();
                } else{
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                }
                DB::commit();
                Cache::forget('single_invoices');
                Cache::forget('patient_accounts');
                Cache::forget('fund_accounts');

                if($this->updateMode){
                    $this->InvoiceUpdated = true;
                } else {
                    $this->InvoiceSaved =true;
                    $doctor = Doctor::find($this->doctor_id);
                    $patient = Patient::find($this->patient_id);
                    Notification::send($doctor , new CreateInvoiceNotification());
                    Notification::send($patient , new AddInvoiceToPatientNotification());
                }
                }catch (\Exception $e) {
                    DB::rollback();
                    $this->catchError = $e->getMessage();
            }
        }

        public function delete($id){
            $this->single_invoice_id = $id;
           }

           public function destroy(){
               Invoice::destroy($this->single_invoice_id);
               Cache::forget('single_invoices');
               return redirect()->route('single_invoices');
           }

           public function print($id)
    {
        $single_invoice = Invoice::findOrFail($id);
        return Redirect::route('Print_single_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->doctor->name,
            'section_id' => $single_invoice->section->name,
            'Service_id' => $single_invoice->service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);
    }

}
