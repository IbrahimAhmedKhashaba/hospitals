<?php

namespace App\Interfaces\LaboratoryEmployeeDashboard\Invoices;

interface InvoiceRepositoryInterface
{
    public function index();
    public function edit($id);

    public function update($request,$id);

    public function completedInvoices();

    public function viewLaboratories($id);

}
