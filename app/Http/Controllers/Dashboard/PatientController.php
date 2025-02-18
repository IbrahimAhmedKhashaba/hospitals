<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Patients\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientController extends Controller
{
    private $Patient;

    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient = $Patient;
    }

    public function index()
    {
        return $this->Patient->index();
    }

    public function create()
    {
        return$this->Patient->create();
    }


    public function store(StorePatientRequest $request)
    {
       return $this->Patient->store($request);
    }


    public function show($id)
    {
        return $this->Patient->show($id);
    }


    public function edit($id)
    {
        return $this->Patient->edit($id);
    }


    public function update(StorePatientRequest $request , $id)
    {
        return $this->Patient->update($request , $id);
    }


    public function destroy($id)
    {
       return $this->Patient->destroy($id);
    }
}
