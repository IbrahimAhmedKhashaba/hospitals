<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Interfaces\PatientDashboard\PatientDashboardRepositoryInterface;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    //

    private $patient;

    public function __construct(PatientDashboardRepositoryInterface $patient)
    {
        $this->patient = $patient;
    }

    public function invoices(){
        return $this->patient->invoices();
    }
    public function laboratories(){
        return $this->patient->laboratories();
    }
    public function viewLaboratory($id){
        return $this->patient->viewLaboratory($id);
    }
    public function rays(){
        return $this->patient->rays();
    }
    public function viewRay($id){
        return $this->patient->viewRay($id);
    }
    public function payments(){
        return $this->patient->payments();
    }
}
