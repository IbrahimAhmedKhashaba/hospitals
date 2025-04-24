<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\PatientDetails\PatientDetailsRepositoryInterface;
use App\Repository\DoctorDashboard\PatientDetails\PatientDetailsRepository;

class PatientDetailsController extends Controller
{
    private $patient_details;

    public function __construct(PatientDetailsRepository $patient_details)
    {
        $this->patient_details = $patient_details;
    }
    public function show($id)
    {
        //
        return $this->patient_details->show($id);
    }

}
