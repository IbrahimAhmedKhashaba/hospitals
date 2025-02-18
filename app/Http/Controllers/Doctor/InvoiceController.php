<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\Invoices\InvoiceRepositoryInterface;

class InvoiceController extends Controller
{
    private $invoices;

    public function __construct(InvoiceRepositoryInterface $invoices)
    {
        $this->invoices = $invoices;
    }

    public function index()
    {
        return $this->invoices->index();
    }

    public function completedInvoices()
    {
        return $this->invoices->completedInvoices();
    }

    public function reviewInvoices()
    {
        return $this->invoices->reviewInvoices();
    }
    public function show(string $id)
    {
        //
        return $this->invoices->show($id);
    }
}
