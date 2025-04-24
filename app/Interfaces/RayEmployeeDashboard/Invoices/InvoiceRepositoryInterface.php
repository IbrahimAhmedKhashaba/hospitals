<?php

namespace App\Interfaces\RayEmployeeDashboard\Invoices;

interface InvoiceRepositoryInterface
{
    public function index();
    public function edit($id);

    public function update($request,$id);

    public function completedInvoices();

    public function viewRays($id);

}
