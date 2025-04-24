<?php
namespace App\Repository\DoctorDashboard\Invoices;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\DoctorDashboard\Invoices\InvoiceRepositoryInterface;
use App\Models\Ray;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::with(['patient.translations' , 'service.translations' , 'group.translations'])->where('doctor_id', Auth::user()->id)->where('invoice_status' , 1)->get();
        return view('Dashboard.Doctor.invoices.index' , compact('invoices'));
    }

    public function completedInvoices()
    {
        $invoices = Invoice::with(['patient.translations' , 'service.translations' , 'group.translations'])->where('doctor_id', Auth::user()->id)->where('invoice_status' , 3)->get();
        return view('Dashboard.Doctor.invoices.completedInvoices' , compact('invoices'));
    }

    public function reviewInvoices()
    {
        $invoices = Invoice::with(['patient.translations' , 'service.translations' , 'group.translations'])->where('doctor_id', Auth::user()->id)->where('invoice_status' , 2)->get();
        return view('Dashboard.Doctor.invoices.reviewInvoices' , compact('invoices'));
    }

    public function show($id){
            $ray = Ray::findOrFail($id);
            if($ray->doctor_id != Auth::user()->id){
                return redirect()->route('404');
            }
            return view('Dashboard.Doctor.invoices.view_rays' , compact('ray'));
    }
}

