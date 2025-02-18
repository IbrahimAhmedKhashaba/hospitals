<?php

namespace App\Http\Controllers\RayEmployee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesDashboard\AddRequirmentsToPatientRequest;
use App\Interfaces\RayEmployeeDashboard\Invoices\InvoiceRepositoryInterface;
use App\Models\Ray;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoices;

    public function __construct(InvoiceRepositoryInterface $invoices)
    {
        $this->invoices = $invoices;
    }

    public function index()
    {
        //
        return $this->invoices->index();
    }

    public function store(AddRequirmentsToPatientRequest $request)
    {
        //
        return $this->invoices->store($request);

    }

    public function edit($id)
    {
        //
        return $this->invoices->edit($id);

    }

    public function update(AddRequirmentsToPatientRequest $request, string $id)
    {
        //
        
        return $this->invoices->update($request, $id);
    }

    public function destroy(string $id)
    {
        //
        return $this->invoices->destroy($id);
    }

    public function completedInvoices(){
        return $this->invoices->completedInvoices();
    }

    public function viewRays($id){
        return $this->invoices->viewRays($id);
    }
}
