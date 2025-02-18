<?php

namespace App\Repository\DoctorDashboard\PatientDetails;

use App\Interfaces\DoctorDashboard\PatientDetails\PatientDetailsRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Laboratory;
use App\Models\Ray;

class PatientDetailsRepository implements PatientDetailsRepositoryInterface
{

    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id' , $id)->get();
        $patient_rays = Ray::where('patient_id' , $id)->get();
        $patient_laboratories = Laboratory::where('patient_id' , $id)->get();
        return view('Dashboard.Doctor.Invoices.patient_details' , compact(['patient_records' , 'patient_rays' , 'patient_laboratories']));
    }
}
