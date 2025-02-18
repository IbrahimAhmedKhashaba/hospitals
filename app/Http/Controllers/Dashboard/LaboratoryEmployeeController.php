<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Laboratories\LaboratoryEmployeeRequest;
use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;

class LaboratoryEmployeeController extends Controller
{
    private $laboratory_employee;

    public function __construct(LaboratoryEmployeeRepositoryInterface $laboratory_employee)
    {
        $this->laboratory_employee = $laboratory_employee;
    }
    public function index()
    {
        //
        return $this->laboratory_employee->index();
    }

    public function store(LaboratoryEmployeeRequest $request)
    {
        //
        return $this->laboratory_employee->store($request);
    }

    public function update(LaboratoryEmployeeRequest $request, string $id)
    {
        //
        return $this->laboratory_employee->update($request, $id);
    }

    public function destroy(string $id)
    {
        //
        return $this->laboratory_employee->destroy($id);
    }
}
