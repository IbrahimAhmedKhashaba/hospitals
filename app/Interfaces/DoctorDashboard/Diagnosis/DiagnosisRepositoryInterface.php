<?php

namespace App\Interfaces\DoctorDashboard\Diagnosis;

interface DiagnosisRepositoryInterface
{
    public function store($request);

    public function show($id);

    public function addReview($request);
}
