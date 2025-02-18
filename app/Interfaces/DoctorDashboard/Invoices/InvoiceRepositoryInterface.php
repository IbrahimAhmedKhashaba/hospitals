<?php


namespace App\Interfaces\DoctorDashboard\Invoices;


interface InvoiceRepositoryInterface
{
    public function index();

    public function completedInvoices();

    public function reviewInvoices();

    public function show($id);

    // // show form add
    // public function create();

    // // store Receipt
    // public function store($request);

    // // edit Receipt
    // public function edit($id);

    // // show Receipt
    // public function show($id);

    // // Update Receipt
    // public function update($request);

    // // destroy Receipt
    // public function destroy($request);
}
