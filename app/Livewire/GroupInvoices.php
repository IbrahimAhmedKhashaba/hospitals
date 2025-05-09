<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Group;
use App\Models\GroupInvoice;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Notifications\CreateInvoiceNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class GroupInvoices extends Component
{
    public $InvoiceSaved = false;
    public $InvoiceUpdated = false;
    public $show_table = true;
    public $updateMode = false;
    public $group_invoice_id;
    public $Group_id;
    public $catchError;
    public $price = 0;
    public $patient_id,$doctor_id,$section_id,$type;
    public $discount_value = 0;
    public $tax_rate = 0;
    public $tax_value = 0;
    public function render()
    {
        $group_invoices = Cache::remember('group_invoices' , 3600 , function(){
            return Invoice::with(['group' , 'doctor.translations' , 'patient.translations'])->where('invoice_type' , 2)->get();
        });
        $Patients = Cache::remember('Patients' , 3600 , function(){
            return Patient::with('translations' , 'invoice')->get();
        });
        $doctors = Cache::remember('doctors', 3600, function () {
            return Doctor::with(['translations', 'section.translations', 'image', 'appointments.translations'])->get();
        });
        $groups = Cache::remember('groups' , 3600 , function(){
            return Group::with(['translations' , 'service_group'])->get();
        });
        return view('livewire.GroupInvoices.group-invoices', [
            'group_invoices' => $group_invoices,
            'Patients'=> $Patients,
            'Doctors'=> $doctors,
            'Groups'=> $groups,
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ])->extends('Dashboard.layouts');
    }

    public function show_form_add(){
        $this->show_table = false;
    }


    public function get_section()
    {
        $doctor_id = Doctor::with('section' , 'translations')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price()
    {
        $this->price = Group::where('id', $this->Group_id)->first()->total_before_discount;
        $this->discount_value = Group::where('id', $this->Group_id)->first()->discount_value;
        $this->tax_rate = Group::where('id', $this->Group_id)->first()->tax_rate;
        $this->tax_value = $this->tax_rate * $this->price / 100 ;
    }


    public function store(){
        $group_invoices = [];
        $fund_accounts = [];
        $patient_accounts = [];
        DB::beginTransaction();
            try {
                if($this->updateMode){

                    $this->InvoiceUpdated = true;
                    $group_invoices = Invoice::findOrFail($this->group_invoice_id);
                    if($this->type == 1){
                        $fund_accounts = FundAccount::where('invoice_id' , $this->group_invoice_id)->first();
                    } else{
                        $patient_accounts = PatientAccount::where('invoice_id' , $this->group_invoice_id)->first();
                    }
                } else {

                    $group_invoices = new Invoice();
                    if($this->type == 1){
                        $fund_accounts = new FundAccount();
                    } else{
                        $patient_accounts = new PatientAccount();
                    }
                    $this->InvoiceSaved = true;
                }
                $this->show_table = true;
                $group_invoices->invoice_type = 2;
                $group_invoices->invoice_status = 1;
                $group_invoices->invoice_date = date('Y-m-d');
                $group_invoices->patient_id = $this->patient_id;
                $group_invoices->doctor_id = $this->doctor_id;
                $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $group_invoices->group_id = $this->Group_id;
                $group_invoices->price = $this->price;
                $group_invoices->discount_value = $this->discount_value;
                $group_invoices->tax_rate = $this->tax_rate;
                $group_invoices->tax_value = $this->tax_rate * $this->price / 100 ;
                $group_invoices->total_with_tax = $group_invoices->price -  $group_invoices->discount_value + $group_invoices->tax_value;
                $group_invoices->type = $this->type;
                $group_invoices->save();
                if($this->type == 1){
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $group_invoices->id;
                    $fund_accounts->debit = $group_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();
                } else{
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $group_invoices->id;
                    $patient_accounts->patient_id = $group_invoices->patient_id;
                    $patient_accounts->debit = $group_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                }
                DB::commit();

                Cache::forget('group_invoices');
                Cache::forget('patient_accounts');
                Cache::forget('fund_accounts');
                $doctor = Doctor::find($group_invoices->doctor_id);
                    Notification::send($doctor , new CreateInvoiceNotification());
                }catch (\Exception $e) {
                    DB::rollback();
                    $this->catchError = $e->getMessage();
            }
        }


    public function edit($id){

        $this->show_table = false;
        $this->updateMode = true;
        $group_invoices = Invoice::findOrFail($id);
        $this->group_invoice_id = $group_invoices->id;
        $this->patient_id = $group_invoices->patient_id;
        $this->doctor_id = $group_invoices->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $group_invoices->section_id)->first()->name;
        $this->Group_id = $group_invoices->group_id;
        $this->price = $group_invoices->price;
        $this->discount_value = $group_invoices->discount_value;
        $this->tax_rate = $group_invoices->tax_rate;
        $this->tax_value = $group_invoices->tax_value;
        $this->type = $group_invoices->type;

    }

    public function delete($id){
        $this->group_invoice_id = $id;
    }

    public function destroy(){
        Invoice::destroy($this->group_invoice_id);
        Cache::forget('group_invoices');
        return redirect()->to('/group_invoices');
    }

    public function print($id)
    {
        $single_invoice = Invoice::findOrFail($id);
        return Redirect::route('Print_group_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Group_id' => $single_invoice->Group->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }
}
